<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Package extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'title', 'language', 'price'
    ];

    /**
     * Attributes.
     *
     * @var array
     */
    protected $appends = [
        'is_purchased', 'purchased_issues', 'exist_issues'
    ];

    public function getIsPurchasedAttribute()
    {
        if (!Auth::check())
            return false;

        $purchases = json_decode(Auth::user()->{'purchases_' . $this->language}, true);
        $package_issues = json_decode($this->issues, true);

        return count(array_intersect($package_issues, $purchases)) == count($package_issues);
    }

    public function getPurchasedIssuesAttribute()
    {
        if (!Auth::check())
            return null;

        $purchases = json_decode(Auth::user()->{'purchases_' . $this->language}, true);
        $package_issues = json_decode($this->issues, true);

        return array_intersect($package_issues, $purchases);
    }

    public function getExistIssuesAttribute()
    {
        $issue_numbers = json_decode($this->issues);
        return Issue::where('language', $this->language)->whereIn('issue', $issue_numbers)->get();
    }
}