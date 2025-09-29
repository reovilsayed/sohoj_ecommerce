<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CleanupMemoryIssues extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'cleanup:memory-issues {--force : Force cleanup without confirmation}';

    /**
     * The console command description.
     */
    protected $description = 'Clean up memory-related issues in the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting memory cleanup...');

        if (!$this->option('force') && !$this->confirm('This will clean up sessions, cache, and temporary files. Continue?')) {
            $this->info('Cleanup cancelled.');
            return;
        }

        $this->cleanupSessions();
        $this->cleanupCache();
        $this->cleanupTempFiles();
        $this->optimizeDatabase();

        $this->info('Memory cleanup completed successfully!');
    }

    private function cleanupSessions()
    {
        $this->info('Cleaning up expired sessions...');
        
        try {
            // Clean up expired sessions from database
            $deleted = DB::table('sessions')
                ->where('last_activity', '<', now()->subHours(2)->timestamp)
                ->delete();
            
            $this->info("Deleted {$deleted} expired sessions.");
            
            // Clean up session files if using file driver
            if (config('session.driver') === 'file') {
                $sessionPath = storage_path('framework/sessions');
                if (is_dir($sessionPath)) {
                    $files = glob($sessionPath . '/*');
                    $deletedFiles = 0;
                    
                    foreach ($files as $file) {
                        if (is_file($file) && filemtime($file) < now()->subHours(2)->timestamp) {
                            unlink($file);
                            $deletedFiles++;
                        }
                    }
                    
                    $this->info("Deleted {$deletedFiles} expired session files.");
                }
            }
        } catch (\Exception $e) {
            $this->error("Error cleaning sessions: " . $e->getMessage());
        }
    }

    private function cleanupCache()
    {
        $this->info('Cleaning up cache...');
        
        try {
            Cache::flush();
            $this->info('Cache cleared successfully.');
        } catch (\Exception $e) {
            $this->error("Error clearing cache: " . $e->getMessage());
        }
    }

    private function cleanupTempFiles()
    {
        $this->info('Cleaning up temporary files...');
        
        try {
            $tempPaths = [
                storage_path('app/livewire-tmp'),
                storage_path('app/temp'),
                storage_path('framework/cache'),
                storage_path('framework/views'),
            ];
            
            $deletedFiles = 0;
            
            foreach ($tempPaths as $path) {
                if (is_dir($path)) {
                    $files = glob($path . '/*');
                    foreach ($files as $file) {
                        if (is_file($file) && filemtime($file) < now()->subHours(1)->timestamp) {
                            unlink($file);
                            $deletedFiles++;
                        }
                    }
                }
            }
            
            $this->info("Deleted {$deletedFiles} temporary files.");
        } catch (\Exception $e) {
            $this->error("Error cleaning temp files: " . $e->getMessage());
        }
    }

    private function optimizeDatabase()
    {
        $this->info('Optimizing database...');
        
        try {
            // Get database connection
            $connection = DB::connection();
            
            // Optimize tables that might be causing memory issues
            $tables = ['sessions', 'notifications', 'jobs', 'failed_jobs'];
            
            foreach ($tables as $table) {
                try {
                    $connection->statement("OPTIMIZE TABLE {$table}");
                    $this->info("Optimized table: {$table}");
                } catch (\Exception $e) {
                    $this->warn("Could not optimize table {$table}: " . $e->getMessage());
                }
            }
        } catch (\Exception $e) {
            $this->error("Error optimizing database: " . $e->getMessage());
        }
    }
}
