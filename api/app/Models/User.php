<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use DirectoryTree\Authorization\Traits\Authorizable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property null|string $remember_token
 * @property null|string $avatar
 * @property null|string $current_workspace_id
 * @property null|CarbonInterface $email_verified_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property null|CarbonInterface $deleted_at
 * @property Collection<PersonalAccessToken> $tokens
 * @property Collection<Role> $roles
 * @property Collection<Permission> $permissions
 * @property Workspace $workspace
 * @property Collection<Workspace> $workspaces
 * @property Collection<WorkspaceMember> $memberships
 */
final class User extends Authenticatable implements MustVerifyEmail
{
    use Authorizable;
    use HasApiTokens;
    use HasFactory;
    use HasUuids;
    use Notifiable;
    use SoftDeletes;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'avatar',
        'current_workspace_id',
        'email_verified_at',
    ];

    /** @var array<int,string> */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @return BelongsTo<Workspace> */
    public function workspace(): BelongsTo
    {
        return $this->belongsTo(
            related: Workspace::class,
            foreignKey: 'current_workspace_id',
        );
    }

    /** @return HasManyThrough<Workspace> */
    public function workspaces(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: Workspace::class,        // The related model (final target)
            through: WorkspaceMember::class,  // The intermediate model
            firstKey: 'user_id',              // Foreign key on the intermediate table
            secondKey: 'id',                  // Foreign key on the final table (Workspace)
            localKey: 'id',                   // Local key on this model (User)
            secondLocalKey: 'workspace_id'    // Local key on the intermediate model (WorkspaceMember)
        );
    }

    /** @return HasMany<WorkspaceMember> */
    public function memberships(): HasMany
    {
        return $this->hasMany(
            related: WorkspaceMember::class,
            foreignKey: 'user_id',
        );
    }

    /** @return array<string,string> */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
