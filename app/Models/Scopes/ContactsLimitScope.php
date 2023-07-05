<?php

namespace App\Models\Scopes;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ContactsLimitScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (! App::runningInConsole()) {
            $team = Auth::user()->currentTeam;
            $contactLimitId = Contact::query()->withoutGlobalScopes()->where('team_id', $team->id)->take($team->currentContactsLimit())->orderByRaw('last_enriched_at IS NOT NULL, last_enriched_at DESC')->orderByDesc('id')->get()->last()->id ?? null;
            if ($contactLimitId) {
                $builder->where($model->getTable().'.id', '>=', $contactLimitId);
            }
        }
    }
}
