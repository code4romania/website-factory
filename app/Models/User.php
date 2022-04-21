<?php

declare(strict_types=1);

namespace App\Models;

use App\Notifications\WelcomeNotification;
use App\Traits\Filterable;
use App\Traits\HasRole;
use App\Traits\Sortable;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable implements HasLocalePreference
{
    use Filterable;
    use HasFactory;
    use HasRole;
    use Notifiable;
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'locale',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'avatar',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected array $allowedSorts = [
        'name', 'email', 'role',
    ];

    protected array $allowedFilters = [
        'role',
    ];

    public function filterByRole(Builder $query, $role): Builder
    {
        return $query->whereIn('role', Arr::wrap($role));
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function (self $user) {
            if (! $user->password) {
                $user->password = '_pending_' . Hash::make(Str::random(64));
            }
        });

        static::created(function (self $user) {
            $user->notify(new WelcomeNotification);
        });
    }

    /**
     * Get the user’s preferred locale.
     *
     * @return string
     */
    public function preferredLocale(): string
    {
        return $this->locale ?? config('app.fallback_locale');
    }

    public function getAvatarAttribute(): string
    {
        return Gravatar::get($this->email);
    }
    public function hasSetPassword(): bool
    {
        return ! Str::startsWith($this->password, '_pending_');
    }
}
