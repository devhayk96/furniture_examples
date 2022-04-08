<?php

namespace Database\Seeders;

use App\Models\Pages;
use Illuminate\Database\Seeder;

class TermsOfUseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "slug" => "terms-of-use",
            "title_am" => "Օգտագործման համաձայնագիր",
            "desc_am" => '
            <p>Դառնալով Guyq.am-ի օգտատեր` Դուք ընդունում եք սույն օգտագործման համաձայնագրի պայմանները: Ձեր հայտարարությունը տեղադրելիս` Դուք կրում եք պարունակության ամբողջ պատասխանատվությունը: Կայքն իրավունք է վերապահում չհրապարակել կամ իր կողմից հեռացնել անպատշաճ բովանդակության հայտարարությունը: Կողմերի իրավունքներն ու պարտականութունները Guyq.am կայքում տեղադրված ցանկացած տեղեկությունն ու նյութերը պաշտպանված են հեղինակային իրավունքների մասին սահմանված օրենքով և հանդիսանում են Guyq.am-ի սեփականություն: Դուք չեք կարող պատճենել, վերարտադրել, տարածել, հրապարակել, վերցնել, պահպանել, փոխանցել կամ օգտագործել կայքի ոչ մի մասը, կամ այնտեղ տեղադրված տեղեկությունը: Օգտվելով Guyq.am-ի ծառայություններից` Դուք հաստատում եք այն, որ կրում եք բացառիկ պատասխանատվություն Ձեր կողմից տեղադրված հայտարարության բովանդակության համար, ունեք բոլոր անհրաժեշտ իրավունքներն ու թույլտվությունները տվյալ տեղեկությունը տեղադրելու համար` ներառյալ պատենտները, ապրանքանշանները, կոմերցիոն գաղտնիքներ, ինչպես նաև թույլատվություն բոլոր այն անձանց կողմից, որոնք նշվում են հայտարարության տեքստում:</p>
            <p>Եթե Guyq.am-ում Դուք սխալ կոնտակտային տվյալներ եք տեղադրում կամ օգտվում եք կայքից ուրիշ անվան տակ, մենք մեզ իրավունք ենք վերապահում Ձեր կոնտակտային տվյալները տրամադրել տուժված կողմին միայն օրենքով սահմանված կարգով:</p>
            <p>Չ՛ձեռնարկել որևէ գործողություն, որը կբերի կայքի ենթակառուցվածքի անհամաչափ բարձր ձանրաբեռնմանը; Չ՛օգտագործել ավտոմատ ծրագրեր կայք մուտք գործելու համար;</p>
            <p>Չ՛կանխել և չփորձել կանխել կայքի աշխատանքն ու այտեղ ընթացող այլ գործունեությունը. նաև չկանխել ավտոմատ ծրագրերի և պրոցեսների աշխատանքը;</p>
            <p>Չ՛օգտագործել այլ օգտատերերի կողմից տրամադրված տվյալները որևէ այլ նպատակներով, բացի տվյալ օգտատիրոջ հետ գործարք կատարելու համար;</p>
            <p>Չ՛քննադատել մոդերատորների և ադմինիստրացիայի գործողությունները որևէ այլ տարբերակով, բացի ուղիղ էլեկտրոնային նամակագրությունից;</p>
            <p>Չ՛օգտագործել անուններ, որոնք նման են այլ օգտատերերի անուններին` իրենց տեղ ներկայանալով և իրենց անուններից հաղորդագրություններ գրելով:</p>
            <p>Guyq.am-ը պարտավորվում է ջանքեր գործածել հետևյալ համաձայնագրով իր պարտավորությունները պատշաճ կերպով կատարելու համար` ներառյալ կայքի ծառայությունների նորմալ աշխատանքը և երրորդ անձանց անձնական տվյալներ չտրամադրելը, բացառությամբ օրենքով նախատեսված դեպքերից:</p>
            <p>Guyq.am-ը կարող է ժամանակ առ ժամանակ ծառայությունների օգտագործման սահմանափակումներ սահմանել, օրինակ հայտարարության պիտանելիության ժամկետն ու չափը: Guyq.am-ը իրավասու է ցանկացած պահին փոխել ծառայությունների աշխատանքը`առանց նախորոք զգուշացման` չկրելով որևէ պատասխանատվություն:</p>
            <p>Ծառայությունների բարձր որակը պահելու համար Guyq.am-ը կարող է սահմանափակել օգտատիրոջ ակտիվ հայտարարությունների քանակը, նաև սահմանափակել Guyq.am-ում օգտատիրոջ գործողությունները: Guyq.am-ը կարող է արգելել օգտատիրոջ մուտքը կայք, եթե նա խախտում է տվյալ համաձայնագրի պայմանները:</p>
            <p>Guyq.am կայքը իրավունք ունի ցանկացած պահին հեռացնել և անջատել էջը և հեռացնել բոլոր հայտարարությունները` թողնելով օգտատիրոջը նախնական ծանուցման որոշումը ինքն իրեն և պատասխանատվություն չկրելով իր գործողությունների համար ո’չ օգտատիրոջ և ո’չ էլ երրորդ անձանց դիմաց:</p>
            <p>Guyq.am-ի ադմինիստրացիան իրավունք է վերապահում ցանկացած պահին օգտատիրոջ հետ տվյալների ճշտելը և պահանջել անձը հաստատող փաստաթուղթ: Վերոհիշյալները չտրամադրելը հավասարեցվում է ոչ պատշաճ տեղեկությունների տրամադրելուն: Այն դեպքում, երբ օգտատիրոջ կոցմից տրամադրված փաստաթղթերը չեն համապատասխանում գրանցվելիս տրամադրված տվյալների հետ, Guyq.am-ը իրավունք ունի օգտատիրոջը մերժելու և նրան Guyq.am-ի մուտքը փակելու առանց նախաղգուշացման:</p>
            ',
            "title_en" => "Terms of use",
            "desc_en" => '
            <p>By becoming a Guyq.am user, you accept the terms of this agreement. By posting your ad, you are solely responsible for the content. The site reserves the right not to publish or remove inappropriate content. Rights and Responsibilities of the Parties Any information and materials posted on Guyq.am are protected by copyright law and are the property of Guyq.am. You may not copy, reproduce, distribute, publish, publish, retrieve, transfer or use any part of the Site or any information contained therein. By using Guyq.am services, you confirm that you are solely responsible for the content of the advertisement posted by you, you have all the necessary rights and permissions to post this information, including patents, trademarks, trade secrets, as well as permission to all those persons. by which are mentioned in the text of the announcement.</p>
            <p>If you post incorrect contact information on Guyq.am or use the site under another name, we reserve the right to provide your contact information to the aggrieved party only in accordance with the law.</p>
            <p>Do not take any action that would result in a disproportionately high load on the site infrastructure; Do not use automated software to access the site;</p>
            <p>Do not prevent, do not try to prevent the work of the site and other activities taking place there. also prevent the operation of automated programs and processes;</p>
            <p>Do not use the information provided by other users for any purpose other than to make a transaction with that user;</p>
            <p>Do not criticize the actions of the moderators ակով administration in any other way than direct e-mail;</p>
            <p>Do not use names that are similar to the names of other users who appear in their place and write messages on their behalf.</p>
            <p>Guyq.am undertakes to make every effort to fulfill its obligations under the following agreement, including the normal operation of the site\'s services and the non-provision of personal data to third parties, except as provided by law.</p>
            <p>Guyq.am may from time to time restrict the use of the Services, such as the expiration date and size of the advertisement. Guyq.am reserves the right to change the work of the services at any time without prior notice, without taking any responsibility.</p>
            <p>In order to maintain the high quality of the services, Guyq.am may limit the number of active announcements of the user, as well as limit the actions of the user in Guyq.am. Guyq.am may prohibit the user from entering the site if he violates the terms of this agreement.</p>
            <p>Guyq.am website has the right to remove ել turn off the page և remove all announcements at any time, leaving the user with the decision of prior notification, without taking responsibility for his actions either to the user or to third parties.</p>
            <p>The Guyq.am administration reserves the right to verify the data with the user at any time and to request an identity document. Failure to provide the above is tantamount to providing inadequate information. In case the documents provided by the user do not correspond to the data provided during registration, Guyq.am has the right to refuse the user and block him from Guyq.am without warning.</p>
            ',
            "title_ru" => "Условия эксплуатации",
            "desc_ru" => '
            <p>Став пользователем Guyq.am, вы принимаете условия этого соглашения. Размещая свое объявление, вы несете единоличную ответственность за его содержание. Сайт оставляет за собой право не публиковать или удалять недопустимый контент. Права и обязанности сторон Любая информация и материалы, размещенные на Guyq.am, защищены законом об авторском праве и являются собственностью Guyq.am. Вы не можете копировать, воспроизводить, распространять, распространять, публиковать, извлекать, передавать или использовать любую часть Сайта или любую информацию, содержащуюся на нем. Используя услуги Guyq.am, вы подтверждаете, что несете единоличную ответственность за содержание размещенного вами объявления, обладаете всеми необходимыми правами и разрешениями для размещения этой информации, включая патенты, товарные знаки, коммерческую тайну, а также разрешение на все те лица, которые упомянуты в тексте объявления.</p>
            <p>Если вы размещаете неверную контактную информацию на Guyq.am или используете сайт под другим именем, мы оставляем за собой право предоставить вашу контактную информацию потерпевшей стороне только в соответствии с законом.</p>
            <p>Не предпринимать никаких действий, которые могут привести к непропорционально высокой нагрузке на инфраструктуру сайта; Не используйте автоматизированное программное обеспечение для доступа к сайту;</p>
            <p>Не препятствовать, не пытаться препятствовать работе сайта и другим происходящим там действиям. также предотвратить работу автоматизированных программ и процессов;</p>
            <p>Не используйте информацию, предоставленную другими пользователями, для каких-либо целей, кроме как для совершения транзакции с этим пользователем;</p>
            <p>Не критикуйте действия модераторов ակով администрацией каким-либо иным способом, кроме прямой электронной почты;</p>
            <p>Не используйте имена, похожие на имена других пользователей, появляющиеся на их месте и пишущие сообщения от их имени.</p>
            <p>Guyq.am обязуется приложить все усилия для выполнения своих обязательств по нижеследующему соглашению, включая нормальную работу сервисов сайта и непредоставление персональных данных третьим лицам, за исключением случаев, предусмотренных законодательством.</p>
            <p>Guyq.am может время от времени ограничивать использование Услуг, например, срок действия и размер рекламы. Guyq.am оставляет за собой право изменять работу сервисов в любое время без предварительного уведомления, не неся при этом никакой ответственности.</p>
            <p>В целях поддержания высокого качества услуг Guyq.am может ограничивать количество активных объявлений пользователя, а также ограничивать действия пользователя в Guyq.am. Guyq.am может запретить пользователю вход на сайт, если он нарушает условия настоящего соглашения.</p>
            <p>Сайт Guyq.am имеет право удалить ել закрыть страницу և удалить все объявления в любое время, оставив за пользователем решение предварительного уведомления, не неся ответственности за свои действия ни перед пользователем, ни перед третьими лицами.</p>
            <p>Администрация Guyq.am оставляет за собой право в любое время сверить данные с пользователем и запросить документ, удостоверяющий личность. Непредоставление вышеуказанного равносильно предоставлению недостоверной информации. В случае, если документы, предоставленные пользователем, не соответствуют данным, указанным при регистрации, Guyq.am имеет право отказать пользователю и заблокировать его в Guyq.am без предупреждения.</p>
            ',
            'image' => null,
        ];
        Pages::create($data);
    }
}
