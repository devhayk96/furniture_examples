<?php

namespace Database\Seeders;

use App\Models\WebsiteInfo;
use Illuminate\Database\Seeder;

class WebsiteInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $footer_links = [
            0 => [
                "title_am" => "Անշարժ գույք",
                "title_en" => "Real Estate",
                "title_ru" => "Недвижимость",
                "link" => "home"
            ],
            1 => [
                "title_am" => "Ծառայություններ",
                "title_en" => "Services",
                "title_ru" => "Услуги",
                "link" => "home"
            ],
            2 => [
                "title_am" => "Մեր Մասին",
                "title_en" => "About",
                "title_ru" => "О нас",
                "link" => "about-us"
            ],
            3 => [
                "title_am" => "Հետադարձ կապ",
                "title_en" => "Contacts Us",
                "title_ru" => "Связаться с нами",
                "link" => "contact-us-page"
            ],
            4 => [
                "title_am" => "Օգտագործման համաձայնագիր",
                "title_en" => "Terms of use",
                "title_ru" => "Условия эксплуатации",
                "link" => "terms-of-use"
            ]
        ];
        $photo_service = [
            "title_am" => "Ֆոտո ծառայություն",
            "title_en" => "Photo service",
            "title_ru" => "Фотосервис",
            "image_url" => "",
            "desc_am" => "Այսուհետ դուք կարող եք պատվիրել Ձեր գույքի նկարները։ զանգահարեք 87596552 համարով և պրոֆեսիոնալ լուսանկարիչները կնկարեն
                            Ձեր գույքը և կներբեռնեն նկարները կայքում Ձեր փոխարեն։ Ընտրեք արագ վաճառքի արդյունավետ տարբերակ։",
            "desc_en" => "From now on you can order pictures of your property. Call 87596552 and Professional photographers will take pictures of
                            your property and will upload the pictures on the website for you. Choose an effective fast selling option.",
            "desc_ru" => "Отныне вы можете заказать фотографии вашей недвижимости. Звоните 87596552 и Профессиональные фотографы снимут
                            вашу недвижимость и загрузят фотографии на сайт для вас. Выберите эффективный вариант быстрой продажи.",
        ];
        $websiteInfo = [
            'email' => 'info@guyq.am',
            'address_am' => 'Հայաստան, Երևան, Արամի 86',
            'address_en' => 'Armenia, Yerevan, Arami 86',
            'address_ru' => 'Армения, Ереван, Арами 86',
            'phone_number' => '+374 99 535 235',
            'office_phone_number' => '+374 98 535 235',
            'footer_links' => $footer_links,
            'photo_service' => $photo_service,
        ];
        WebsiteInfo::create($websiteInfo);
    }
}
