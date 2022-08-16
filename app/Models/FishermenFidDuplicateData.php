<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FishermenInfoStatsInfo;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Image;
use Carbon\Carbon;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class FishermenFidDuplicateData extends Model
{
    use HasFactory;
    protected $table = 'fishermen_fid_duplicate_data';

   
}
