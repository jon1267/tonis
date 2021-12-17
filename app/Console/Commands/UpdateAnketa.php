<?php

namespace App\Console\Commands;

use App\Services\Import\Csv;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Для работы дожен быть файл public/src/anketa_all.csv с данными.
 * Обновление таблицы landing_good данными анкеты подбора парфюмов -
 * (до 45 или после, сезонов года, темпераметров, ароматов ... )
 */
class UpdateAnketa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:anketa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update landing_good table with data for select parfumes anketa';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!file_exists(public_path('src/upd_anketa.sql'))) {
            $this->csvUpdate();
        }

        DB::unprepared(file_get_contents(public_path('src/upd_anketa.sql')));
        echo 'All done.';

        return Command::SUCCESS;
    }

    private function csvUpdate()
    {
        $data = Csv::parseCsv(public_path('src\anketa_all.csv'), ',');
        //dd($data);

        $file = public_path('src\upd_anketa.sql');

        $update1 = 'UPDATE `landing_good` SET ';
        $update2 = ' WHERE art100=';

        foreach ($data as $items) {
            $update = '';

            $before45 = (trim($items['before45']) === "+" ) ? 1 : 0;
            $after46 = (trim($items['after46']) === "+" ) ? 1 : 0;

            $winter = (trim($items['winter']) === "+" ) ? 'зима, ' :  '';
            $spring = (trim($items['spring']) === "+" ) ? 'весна, ' :  '';
            $summer = (trim($items['summer']) === "+" ) ? 'лето, ' :  '';
            $autumn = (trim($items['autumn']) === "+" ) ? 'осень' :  '';
            $time = $winter . $spring . $summer . $autumn;
            if (substr($time, -2) == ', ') {
                $time = substr($time,0,-2);
            }


            $melan = (trim($items['melan']) === "+" ) ? 'меланхолик, ' :  '';
            $holer = (trim($items['holer']) === "+" ) ? 'холерик, ' :  '';
            $flegm = (trim($items['flegm']) === "+" ) ? 'флегматик, ' :  '';
            $sang = (trim($items['sang']) === "+" ) ? 'сангвиник' :  '';
            $temperament = $melan . $holer . $flegm . $sang;
            if (substr($temperament, -2) == ', ') {
                $temperament = substr($temperament,0,-2);
            }

            $fresh = (trim($items['fresh']) === "+" ) ? 'свежие, ' :  '';
            $sweet = (trim($items['sweet']) === "+" ) ? 'сладкие, ' :  '';
            $citrus = (trim($items['citrus']) === "+" ) ? 'цитрусовые, ' :  '';
            $flower = (trim($items['flower']) === "+" ) ? 'цветочные, ' :  '';
            $tree = (trim($items['tree']) === "+" ) ? 'древесные, ' :  '';
            $fruit = (trim($items['fruit']) === "+" ) ? 'фруктовые' :  '';
            $aromat = $fresh . $sweet . $citrus . $flower . $tree . $fruit;
            if (substr($aromat, -2) == ', ') {
                $aromat = substr($aromat,0,-2);
            }

            $update .= $update1.
                'before45 = "'. $before45 .'", '.
                'after46 = "'. $after46 .'", '.
                'time = "'. $time .'", '.
                'temperament="'. $temperament .'", '.
                'aromat="'. $aromat. '"  '.
                $update2. '"'.$items['art100'].'";'."\n";

            //dd($time, $temperament, $aromat, $update);
            file_put_contents($file, $update, FILE_APPEND);
        }
    }
}
