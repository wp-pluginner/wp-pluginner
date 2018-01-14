<?php

namespace WpPluginner\Model;

use WpPluginium\Framework\Foundation\Model;

class Example extends Model
{
    protected $table = 'wp_pluginner_example';
    public $timestamps = false;
    protected $guarded = ['id'];
}
