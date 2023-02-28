<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class typeImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $foods = Type::all();
        // file_put_contents('dump.json', $foods);

        $americana = Type::where('name', 'americana')->first();
        $americana->img_url = 'https://www.gardengourmet.it/sites/default/files/recipes/aeead5804e79ff6fb98b2039619c5230_200828_MEDIAMONKS_GG_Spicytarian.jpg';
        $americana->update();

        $araba = Type::where('name', 'araba')->first();
        $araba->img_url = 'http://www.ricettegourmet.com/wp-content/uploads/2017/02/Falafel-con-hummus.jpg';
        $araba->update();
        $argentina = Type::where('name', 'argentina')->first();
        $argentina->img_url = 'https://cdn.shopify.com/s/files/1/1186/6036/articles/grilled-picanha-traditional-brazilian-cut_538646-469.jpg';
        $argentina->update();
        $brasiliana = Type::where('name', 'brasiliana')->first();
        $brasiliana->img_url = 'https://wips.plug.it/cips/buonissimo.org/cms/2012/03/moqueca-5.jpg';
        $brasiliana->update();
        $cinese = Type::where('name', 'cinese')->first();
        $cinese->img_url = 'https://www.tasteasianfood.com/wp-content/uploads/2021/04/Kung-pao-shrimp-featured-image.jpg';
        $cinese->update();
        $fastfood = Type::where('name', 'fast-food')->first();
        $fastfood->img_url = 'https://wips.plug.it/cips/buonissimo.org/cms/2018/02/chicken-wrap-2.jpg';
        $fastfood->update();
        $francese = Type::where('name', 'francese')->first();
        $francese->img_url = 'https://www.cuisine-blog.fr/wp-content/uploads/2019/06/escargots-01.jpg';
        $francese->update();
        $giapponese = Type::where('name', 'giapponese')->first();
        $giapponese->img_url = 'https://www.ricettedigusto.info/wp-content/uploads/2022/01/Gyoza-1200x900.jpg';
        $giapponese->update();
        $italiana = Type::where('name', 'italiana')->first();
        $italiana->img_url = 'https://media-assets.lacucinaitaliana.it/photos/635169cdbc2c8a8e10d1f342/16:9/w_2560%2Cc_limit/GettyImages-482478191.jpg';
        $italiana->update();
        $mediterranea = Type::where('name', 'mediterranea')->first();
        $mediterranea->img_url = 'https://primochef.it/wp-content/uploads/2019/07/SH_spaghetti_alla_puttanesca.jpg';
        $mediterranea->update();
        $steakhouse = Type::where('name', 'steakhouse')->first();
        $steakhouse->img_url = 'https://cdn.ilclubdellericette.it/wp-content/uploads/2019/06/tagliata-di-manzo-1280x720.jpg';
        $steakhouse->update();
        $pizza = Type::where('name', 'pizza')->first();
        $pizza->img_url = 'https://primochef.it/wp-content/uploads/2019/08/SH_pizza_fatta_in_casa-1200x800.jpg';
        $pizza->update();
    }
}
