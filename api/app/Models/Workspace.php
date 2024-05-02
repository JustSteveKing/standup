<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\WorkspaceObserver;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $color
 * @property null|string $logo
 * @property null|string $description
 * @property string $user_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property User $owner
 * @property Collection<WorkspaceMember> $members
 */
#[ObservedBy(WorkspaceObserver::class)]
final class Workspace extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'color',
        'logo',
        'description',
        'user_id',
    ];

    /** @return BelongsTo<User> */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /** @return HasMany<WorkspaceMember> */
    public function members(): HasMany
    {
        return $this->hasMany(
            related: WorkspaceMember::class,
            foreignKey: 'workspace_id',
        );
    }
}
