<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'icon' => '/images/services/icons/evaluation.png',
                'menu_title_am' => 'գնահատում',
                'menu_title_en' => 'evaluation',
                'menu_title_ru' => 'оценка',
                'page_title_am' => 'անշարժ գույքի գնահատում',
                'page_title_en' => 'property valuation',
                'page_title_ru' => 'оценка недвижимости',
                'desc_am' => 'Անշարժ գույքի գնահատման գործունեությունը կարգավորվում է Հայաստանի Հանրապետության
                                քաղաքացիական օրենսգրքով: Հայաստանի Հանրապետությունում անշարժ գույքի գնահատման ստանդարտով
                                և այլ նորմատիվ իրավական ակտերով, ինչպես նաև Հայաստանի Հանրապետության միջազգային
                                պայմանագրերով: Անշարժ գույքի գնահատումը բարդ գործընթաց է, որը պահանջում է համապատասխան
                                գիտելիքներ, բարձր որակավորում ունեցող մասնագետների աշխատանք՝ հիմնված գնահատման
                                սկզբունքների և մեթոդների վրա: Ժամանակի ընթացքում կազմակերպության կազմը համալրվել է
                                արհեստավարժ գնահատող մասնագետներով և տեխնիկական ու ծրագրային արդիական միջոցներով:
                                Կարելի է ասել, որ կազմակերպությունը ճիշտ կառավարման համակարգի, հետևողական աշխատանքի և
                                մատուցած ծառայությունների պատշաճ որակի շնորհիվ ՀՀ տարածքում գտնվում է ոլորտի առաջատար
                                դիրքերում: Գնահատման օբյեկտներ կարող են հանդիսանալ՝ Բնակարաններ Բնակելի տներ (առանձնատուն)
                                Ավտոտնակներ Բազմաբնակարան շենքեր Գրասենյակային տարածքներ Արտադրական տարածքներ
                                Հասարակական տարածքներ Այլ շենքեր և շինություններ Անշարժ գույքի շուկայական արժեքի
                                գնահատումը ամենապահանջված գնահատման տեսակն է Ընկերությունը իրականացնում է՝ 1. Բնակարանների,
                                բնակելի տների, այգետնակների գնահատում 2. Հասարակական նշանակության շինությունների գնահատում
                                3. Բազմաֆունկցիոնալ շենքերի և շինությունների գնահատում 4. Արտադրական նշանակության
                                շինությունների գնահատում 5. Հողամասերի գնահատում 6. Ավտոտնակների գնահատում
                                7. Հատուկ նշանակության անշարժ գույքի(մասնագիտացված անշարժ գույք) գնահատում',
                'desc_en' => 'Real estate appraisal activities are regulated by the Civil Code of the Republic of Armenia.
                                By the standard of real estate appraisal in the Republic of Armenia, by other normative
                                legal acts, as well as by international agreements of the Republic of Armenia. Real
                                estate appraisal is a complex process that requires relevant knowledge, the work of
                                highly qualified professionals based on the principles and methods of appraisal.
                                Over time, the staff of the organization has been supplemented with professional
                                assessment specialists, modern technical and software means. It can be said that
                                the organization is in a leading position in the field of the Republic of Armenia
                                due to the correct management system, consistent work and the quality of services
                                provided. Appraisal objects can be: Apartments Residential houses (private houses)
                                Garages Apartment buildings Office premises Industrial areas Public spaces Other
                                buildings և Buildings The market value of real estate is the most demanded type of
                                appraisal The company carries out: 1. Apartments, residential houses Appraisal of
                                buildings 3. Assessment of multifunctional buildings 4. Assessment of industrial
                                buildings 5. Assessment of land plots 6. Assessment of garages 7. Assessment of
                                special purpose real estate (specialized real estate)',
                'desc_ru' => 'Деятельность по оценке недвижимости регулируется Гражданским кодексом Республики Армения.
                                В соответствии со стандартами оценки недвижимости в Республике Армения, другими
                                нормативными правовыми актами, а также международными договорами Республики Армения.
                                Оценка недвижимости - сложный процесс, требующий соответствующих знаний, работы
                                высококвалифицированных специалистов, основанной на принципах и методах оценки.
                                Со временем штат организации пополнился профессиональными специалистами по оценке,
                                современными техническими и программными средствами. Можно сказать, что организация
                                занимает лидирующие позиции в сфере Республики Армения благодаря правильной системе
                                управления, слаженной работе и качеству предоставляемых услуг. Объектами оценки могут
                                быть: Квартиры Жилые дома (частные дома) Гаражи Многоквартирные дома Офисные помещения
                                Промышленные площади Общественные помещения Другие здания և Здания Рыночная стоимость
                                недвижимости - самый востребованный вид оценки. Компания проводит: 1. Оценка квартир,
                                жилых домов зданий 3. Оценка многофункциональных зданий 4. Оценка производственных
                                зданий 5. Оценка земельных участков 6. Оценка гаражей 7. Оценка недвижимого имущества
                                специального назначения (специализированная недвижимость)',
            ],
            [
                'icon' => '/images/services/icons/construction.png',
                'menu_title_am' => 'շինարարություն',
                'menu_title_en' => 'construction',
                'menu_title_ru' => 'строительство',
                'page_title_am' => 'շինարարություն',
                'page_title_en' => 'construction',
                'page_title_ru' => 'строительство',
                'desc_am' => 'Բնակարանի կամ առանձնատան կառուցումն ու ներքին և արտաքին ձևավորումը պահանջում է ոլորտին
                                համապատասխան գիտելիքների մեծ պաշար, քանի որ բնակելի կամ հասարակական ցանկացած շինություն
                                նախատեսված է երկարաժամկետ շահագործման համարֈ Հետևաբար, մոտեցումներն ամենախիստն են
                                շինարարության և ճարտարապետության հարցերում: “Guyq.am” ընկերությունը կարող է օգնել Ձեզ
                                ճիշտ կողմնորոշվել և խուսափել ծախսատար սխալներից՝ ապահովելով. 1. Խորհրդատվություն և խորը
                                ուսումնասիրում՝ Ձեր հետ միասին 2. Ամբողջական շինարարական ծառայությունների փաթեթ
                                3. Նախագծի հաստատման և շինարարության թույլտվություն 4. Շահագործում և նախագծի հանձնում:
                                Մեր ընկերությունը համագործակցում է ինչպես հայաստանյան, այնպես էլ արտասահմանյան շինանյութ
                                ներկրող ընկերությունների հետ, որը թույլ է տալիս բավարարել այսօրվա շուկայի պահանջները:
                                Համագործակցելով մեզ հետ հաճախորդը զերծ է մնում առաջացող խնդիրներից և չունի անհանգստանալու
                                պատճառ շինանյութի ընտրության հարցում: Ունենալով մեծ ընտրության հնարավորություն և՛ հայաստանյան,
                                և՛ արտասահմանյան ծագման շինանյութի. մենք օգտագործում ենք ամենաորակյալը: Նոր տարածքում
                                ապրելակերպը ճիշտ կազմակերպելու և հաճելի դարձնելու համար ճարտարապետն ու դիզայները առաջին
                                հերթին համակարգչի միջոցով մանրամասն մոդելավորում են բնակելի տարածքը, այլ կերպ ասած՝
                                “կառուցում են” Ձեր տունը համակարգչի էկրանին, որից հետո ձևավորում արտաքին և ներքին տեսքն՝
                                ըստ Ձեր ընտրած գույների և նյութերիֈ Այդ գործընթացին Դուք կարող եք ցուցաբերել ակտիվ
                                մասնակցություն, կատարել փոփոխություններ՝ իրականացնելով Ձեր պատկերացումներն ու
                                երևակայությունըֈ Այնուհետև բոլոր հարցերի շուրջ մասնագետների հետ համաձայնության գալով՝
                                հաստատում եք Ձեր նոր վիրտուալ տունը՝ բոլոր մանրամասնություններով, օրինակ՝ կառուցապատման
                                վայրը, լողավազանը, այգին, կից կառույցները, որից հետո շինարարները սկսում են իրականություն
                                դարձնել Ձեր երազանքը Պատվիրատուի իրավունքները պաշտպանելու, երկկողմանի պարտականություններն
                                ամրագրելու համար կնքում ենք պայմանագիր: Աշխատում ենք և՛ կանխիք, և՛ անկանխիկ վճարումով:
                                Վճարումները կատարվում են փուլ առ փուլ:',
                'desc_en' => 'The construction and interior and exterior design of an apartment or house requires a great
                                deal of knowledge relevant to the field, as any residential or public building is designed
                                for long-term use. "Guyq.am" company can help you orient yourself correctly, avoid costly
                                mistakes by ensuring: 1. Consulting և In-depth study with you 2. Complete construction
                                services package 3. Project approval և Construction permit 4. Operation և Project submission.
                                Our company cooperates with companies importing both Armenian and foreign construction materials,
                                which allows us to meet the demands of today\'s market. By cooperating with us, the customer
                                avoids any problems, has no reason to worry about the choice of construction material.
                                Having a great choice of construction materials of both Armenian and foreign origin.
                                we use the highest quality. In order to make living in a new space right, to make it
                                enjoyable, the architect and designer first use a computer to model the living space in
                                detail, in other words, "build" your house on a computer screen, then create the exterior
                                and interior according to the colors և materials ֈ You can take an active part in the
                                process, make changes by realizing your ideas and imagination. They start making your
                                dream come true. We sign a contract to protect the rights of the Customer, to fix the
                                mutual responsibilities. We work with "cash" and "non-cash payment". Payments are made in stages.',
                'desc_ru' => 'Строительство, дизайн интерьера и экстерьера квартиры или дома требует больших знаний
                                в данной области, так как любое жилое или общественное здание спроектировано для
                                долгосрочного использования. Компания "Guyq.am" может помочь вам правильно сориентироваться,
                                избежать дорогостоящих ошибок, обеспечив: 1. Консультации և Детальное изучение с вами
                                2. Полный пакет строительных услуг 3. Утверждение проекта և Разрешение на строительство
                                4. Эксплуатация և Подача проекта. Наша компания сотрудничает с компаниями-импортерами
                                строительных материалов как из Армении, так и из-за рубежа, что позволяет нам соответствовать
                                требованиям сегодняшнего рынка. Сотрудничая с нами, заказчик избегает каких-либо проблем,
                                ему не нужно беспокоиться о выборе строительного материала. Большой выбор строительных
                                материалов как армянского, так и зарубежного производства. мы используем самое высокое качество.
                                Чтобы жить в новом пространстве правильно, чтобы оно приносило удовольствие, архитектор
                                и дизайнер сначала используют компьютер для детального моделирования жилого пространства,
                                другими словами, «строят» свой дом на экране компьютера, а затем создают экстерьер.
                                и интерьер по цветовой гамме և материалы ֈ Вы можете принимать активное участие в процессе,
                                вносить изменения, реализуя свои идеи и воображение. Они начинают воплощать вашу мечту
                                в реальность. Заключаем договор о защите прав Заказчика, фиксируем взаимную ответственность.
                                Работаем с «наличным» и «безналичным расчетом». Выплаты производятся поэтапно.',
            ],
            [
                'icon' => '/images/services/icons/design.png',
                'menu_title_am' => 'դիզայն',
                'menu_title_en' => 'design',
                'menu_title_ru' => 'дизайн',
                'page_title_am' => 'դիզայն',
                'page_title_en' => 'design',
                'page_title_ru' => 'дизайн',
                'desc_am' => 'Դիզայնը և վերանորոգումը իրար հաջորդող գործողություններ են: Ներքին հարդարումը (դիզայն)
                                նույնքան կարևոր նշանակություն ունի, որքան շինարարությունն ու ճարտարապետությունըֈ
                                Եթե շինարարությունն ու ճարտարապետությունն ազդեցություն ունեն հասարակության շահերի վրա,
                                ապա ձևավորումը անմիջականորեն թելադրում է միայն Ձեր ճաշակըֈ Եթե դուք նոր եք պլանավորում
                                տան ներքին հարդարման աշխատանքները՝ 3D մոդելավորումը ձեզ կհետաքրքրի, այն թույլ կտա տեսնել
                                ոչ միայն ներքին հարդարման վերջնական արդյունքը, այլ ունենալ պարզ և համաձայնեցված
                                պատկերացում նախագծի վերաբերյալ: 3D տեխնոլոգիաների շնորհիվ պատվիրատուն հնարավորություն է
                                ունենում. զգալ տարածության չափերը, անել ճիշտ հաշվարկներ՝ աշխատանքների և ծախսվող նյութերի
                                վերաբերյալ, տեսնել ինչպիսի վերջնական տեսք կունենա իր տան ինտերիերը ներքին հարդարման
                                աշխատանքներից հետո, որ վայրերում կդրվի կահույքը կամ ինտերիերի մնացած տարրերը:
                                Դիզայներական աշխատանքի ժամանակ Դուք ունեք հնարավորություն տեսնելու Ձեր երազանքների
                                բնակարանը, քայլել բնակարանում, ճիշտ և համահունչ տեղադրել կահույքը, հարմարեցնելով Ձեզ՝
                                տեղափոխել ներքին պատերը, սալիկապատել և՛ սանհանգույցը, և՛ խոհանոցը:',
                'desc_en' => 'Design and renovation are consistent steps. Interior design is just as important as
                                construction and architecture. If construction and architecture have an impact on the
                                public interest, design directly dictates only your taste. To see not only the final
                                result of the interior, but also to have a clear, coordinated idea of it.
                                Design. Thanks to 3D technologies, the customer has the opportunity to: feel the size
                                of the room, make accurate calculations for work and consumables, see how the final
                                view of the interior of his house will look after interior decoration, where furniture
                                or other interior elements will be placed. During design work, you have the opportunity
                                to see the apartment of your dreams, walk around the apartment, arrange furniture
                                correctly, adapt it, move the interior walls, lay out the tiles "bathroom", "kitchen".',
                'desc_ru' => 'Дизайн и ремонт - последовательные действия. Дизайн интерьера так же важен, как
                                строительство и архитектура. Если строительство и архитектура оказывают влияние на
                                общественные интересы, дизайн напрямую диктует только ваш вкус. Видеть не только
                                конечный результат интерьера, но и иметь четкое согласованное представление о нем.
                                Дизайн. Благодаря 3D-технологиям заказчик имеет возможность: почувствовать размер
                                помещения, произвести точные расчеты по работе и расходным материалам, увидеть, как
                                будет выглядеть окончательный вид интерьера своего дома после внутренней отделки, где
                                будет размещаться мебель или другие элементы интерьера . Во время дизайнерских работ
                                у вас есть возможность увидеть квартиру своей мечты, прогуляться по квартире, правильно
                                расставить мебель, адаптировать ее, перенести внутренние стены, выложить плиткой
                                «ванную», «кухню».',
            ],
            [
                'icon' => '/images/services/icons/renovation.png',
                'menu_title_am' => 'վերանորոգում',
                'menu_title_en' => 'renovation',
                'menu_title_ru' => 'ремонт',
                'page_title_am' => 'անշարժ գույքի վերանորոգում',
                'page_title_en' => 'real estate renovation',
                'page_title_ru' => 'ремонт недвижимости',
                'desc_am' => 'Վերանորոգումը ևս մեր ընկերության հիմնական գործունեություններից է, ընկերությունը
                                իրականացնում է 1. Բնակարանների 2. Սեփական տների 3. Ամառանոցների 4. Կոմերցիոն տարածքների
                                վերանորոգում: Անհրաժե՞շտ է արագ, որակյալ և երաշխավորված վերանորոգում, մենք կարող ենք
                                օգնել Ձեզ: Մեր ընկերությունը ուրախ համագործակցել յուրաքանչյուր հաճախորդի հետ, կիրառելով
                                անհատական մոտեցում, չմոռանալով նրա ֆինանսական հնարավորությունների մասին: Մենք կուտակել ենք
                                բավականին մեծ փորձ և յուրաքանչյուր աշխատանք կատարում ենք առավելագույն պատասխանատվությամբ:
                                Վերանորոգումը կատարվում է պատվիրատուի բոլոր պահանջներին համապատասխան: Մենք կարող ենք
                                կատարել ինչպես ներքին հարդարման աշխատանքներ, այնպես էլ կազմակերպել խորհրդատվություն տան
                                ներքին դիզայնի վերաբերյալ: Կատարելով վերանորոգում մեր միջոցով, Դիզայն-նախագիծը կկատարվի
                                ըստ Ձեր ցանկության և ճաշակի՝ ԱՆՎՃԱՐ հիմունքներով, որակով և ճիշտ ժամանակին:',
                'desc_en' => 'Renovation is one of the main activities of our company, the company carries out
                                1. Apartments 2. Private houses 3. Summer houses 4. Commercial areas. Need a quick,
                                quality և guaranteed repair, we can help you. Our company is happy to cooperate with
                                each customer, applying an individual approach, not forgetting about his financial
                                capabilities. We have accumulated a lot of experience, we do every job with maximum
                                responsibility. The repair is carried out in accordance with all the requirements of the
                                customer. We can do both interior decoration and interior design consulting. Making
                                repairs through us, the design project will be done according to your wishes և taste,
                                on a FREE basis, quality և at the right time.',
                'desc_ru' => 'Ремонт - одно из основных направлений деятельности нашей компании, компания выполняет
                                1. Квартиры 2. Частные дома 3. Летние домики 4. Коммерческие площади. Нужен быстрый
                                качественный և гарантийный ремонт, мы Вам поможем. Наша компания рада сотрудничать
                                с каждым клиентом, применяя индивидуальный подход, не забывая о его финансовых возможностях.
                                У нас накоплен большой опыт, мы выполняем каждую работу с максимальной ответственностью.
                                Ремонт проводится с соблюдением всех требований заказчика. Мы можем предоставить консультации
                                как по внутренней отделке, так и по дизайну интерьера. Делая ремонт через нас, дизайн-проект
                                будет выполнен с учетом ваших пожеланий և вкуса, БЕСПЛАТНО, качественно և в нужное время.',
            ],

        ];

        Service::insert($services);

    }
}
