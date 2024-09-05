<?php

namespace Fintech\Card\Models;

use Fintech\Auth\Models\User;
use Fintech\Core\Abstracts\BaseModel;
use Fintech\Core\Traits\AuditableTrait;
use Fintech\Transaction\Models\UserAccount;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrepaidCard extends BaseModel
{
    use AuditableTrait;
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $casts = ['timeline' => 'array', 'instant_card_data' => 'array', 'restored_at' => 'datetime', 'issued_at' => 'datetime', 'expired_at' => 'datetime', 'enabled' => 'bool'];

    protected $hidden = ['creator_id', 'editor_id', 'destroyer_id', 'restorer_id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Get the user that owns the InstantCard
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('fintech.auth.user_model', User::class));
    }

    /**
     * Get the approver that owns the InstantCard
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(config('fintech.auth.user_model', User::class), 'approver_id');
    }

    /**
     * Get the userAccount that owns the InstantCard
     */
    public function userAccount(): BelongsTo
    {
        return $this->belongsTo(config('fintech.transaction.user_account_model', UserAccount::class));
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /**
     * @return array
     */
    public function getLinksAttribute()
    {
        $primaryKey = $this->getKey();

        $links = [
            'show' => action_link(route('card.instant-cards.show', $primaryKey), __('core::messages.action.show'), 'get'),
            'update' => action_link(route('card.instant-cards.update', $primaryKey), __('core::messages.action.update'), 'put'),
            'destroy' => action_link(route('card.instant-cards.destroy', $primaryKey), __('core::messages.action.destroy'), 'delete'),
            'restore' => action_link(route('card.instant-cards.restore', $primaryKey), __('core::messages.action.restore'), 'post'),
        ];

        if ($this->getAttribute('deleted_at') == null) {
            unset($links['restore']);
        } else {
            unset($links['destroy']);
        }

        return $links;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
