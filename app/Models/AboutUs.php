<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'header_description',
        'header_stats',
        'about_content',
        'about_image_path',
        'about_image_alt',
        'registrations',
        'objectives',
        'projects',
        'team_members',
        'show_registrations',
        'show_objectives',
        'show_projects',
        'show_team',
        'is_active'
    ];

    protected $casts = [
        'header_stats' => 'array',
        'registrations' => 'array',
        'objectives' => 'array',
        'projects' => 'array',
        'team_members' => 'array',
        'show_registrations' => 'boolean',
        'show_objectives' => 'boolean',
        'show_projects' => 'boolean',
        'show_team' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Singleton pattern
    public static function getAboutUs()
    {
        return self::first() ?? new self();
    }

    // Available icons for registrations
    public static function availableRegistrationIcons(): array
    {
        return [
            'FileText' => 'FileText',
            'Shield' => 'Shield',
            'Award' => 'Award',
            'CheckCircle' => 'CheckCircle',
            'Heart' => 'Heart',
            'Target' => 'Target',
            'Home' => 'Home',
            'Users' => 'Users',
            'Certificate' => 'Award',
            'FileCheck' => 'CheckCircle',
        ];
    }

    // Available icons for projects
    public static function availableProjectIcons(): array
    {
        return [
            'Home' => 'Home',
            'Users' => 'Users',
            'Heart' => 'Heart',
            'BookOpen' => 'BookOpen',
            'Shield' => 'Shield',
            'Target' => 'Target',
            'Star' => 'Star',
            'Child' => 'Child',
        ];
    }

    // Helper methods
    public function getHeaderStatsCount(): int
    {
        return count($this->header_stats ?? []);
    }

    public function getRegistrationsCount(): int
    {
        return count($this->registrations ?? []);
    }

    public function getObjectivesCount(): int
    {
        return count($this->objectives ?? []);
    }

    public function getProjectsCount(): int
    {
        return count($this->projects ?? []);
    }

    public function getTeamCount(): int
    {
        return count($this->team_members ?? []);
    }
}