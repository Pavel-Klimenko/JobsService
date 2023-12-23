<?php

//namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;
use App\Models\JobCategories;
use App\Constants;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        //ROLES:
        $roleAdmin = Role::where('name', 'admin')->firstOrFail();
        $roleCandidate = Role::where('name', 'candidate')->firstOrFail();
        $roleCompany = Role::where('name', 'company')->firstOrFail();

        //ADMIN
        User::create([
            'NAME' => 'admin',
            'EMAIL' => 'admin@admin.com',
            'password' => bcrypt('A1P2vK'),
            'role_id' => $roleAdmin->id,
        ]);


        //CANDIDATES
        $category = JobCategories::where('NAME', 'PHP')->firstOrFail();
        User::create([
            'NAME' => 'Pavel',
            'ICON' => Constants::DEMO_ICONS[0],
            'IMAGE' => Constants::DEMO_IMAGES['candidate-pavel'],
            'EMAIL' => 'Pavel@test.com',
            'PHONE' => '+49722211155',
            'password' => bcrypt('almaz'),
            'role_id' => $roleCandidate->id,
            'COUNTRY' => 'USA',
            'CITY' => 'Boston',
            'CATEGORY_ID' => $category->ID,
            'LEVEL' => 'Junior',
            'YEARS_EXPERIENCE' => '1',
            'SALARY' => 500,
            'EXPERIENCE' => 'Experience developing highly scalable and composable RESTful APIs (JSON, API design, HATEOAS, Swagger, Hypermedia, JSON-LD, HAL). Experience using common third-party APIs. Working experience with JIRA and Bitbucket (as well as the Git code repository, including code-reviewing tools)',
            'EDUCATION' => 'DAKOTA STATE UNIVERSITY - UNIVERSITY CENTER. Bachelor\'s Degree in Computer Science',
            'SKILLS' => json_encode(['PHP', 'SQL', 'JS', 'Wordpress', 'Drupal', 'OOP']),
            'LANGUAGES' => json_encode(['english', 'russian']),
            'ACTIVE' => 1,
            'ABOUT_ME' => 'I study specialized literature, maintain a popular blog for programmers, give lectures and seminars, play bowling and table tennis.',
        ]);
        $category = JobCategories::where('NAME', 'java')->firstOrFail();
        User::create([
            'NAME' => 'Olga',
            'ICON' => Constants::DEMO_ICONS[3],
            'IMAGE' => Constants::DEMO_IMAGES['candidate-olga'],
            'EMAIL' => 'Olga@test.com',
            'PHONE' => '+49722211315',
            'password' => bcrypt('almaz'),
            'role_id' => $roleCandidate->id,
            'COUNTRY' => 'Spain',
            'CITY' => 'Madrid',
            'CATEGORY_ID' => $category->ID,
            'LEVEL' => 'Middle',
            'YEARS_EXPERIENCE' => '3',
            'SALARY' => 1500,
            'EXPERIENCE' => 'development of web applications (frontend, backend) on java with using different technologies',
            'EDUCATION' => 'Educational Center of High Technologies Park. Java EE Development',
            'SKILLS' => json_encode(['Java', 'JPA', 'Hibernate ORM', 'Java EE', 'SQL']),
            'LANGUAGES' => json_encode(['english', 'russian']),
            'ACTIVE' => 1,
            'ABOUT_ME' => 'I study specialized literature, maintain a popular blog for programmers, give lectures and seminars, play bowling and table tennis.',
        ]);
        $category = JobCategories::where('NAME', 'python')->firstOrFail();
        User::create([
            'NAME' => 'Victor',
            'ICON' => Constants::DEMO_ICONS[5],
            'IMAGE' => Constants::DEMO_IMAGES['candidate-victor'],
            'EMAIL' => 'Victor@test.com',
            'PHONE' => '+49715811155',
            'password' => bcrypt('almaz'),
            'role_id' => $roleCandidate->id,
            'COUNTRY' => 'Russia',
            'CITY' => 'Moscow',
            'CATEGORY_ID' => $category->ID,
            'LEVEL' => 'Senior',
            'YEARS_EXPERIENCE' => '10',
            'SALARY' => 4500,
            'EXPERIENCE' => 'Part time. Technologies used: Python3.6, Rest API, Django / Django Rest Framework, PostgreSQL, Git, Docker, Swagger.
                            I develop API, participated in the development of the project database schema. Got experience in Swagger development.',
            'EDUCATION' => '2017 – 2021 / Belarusian National Technical University, Faculty of Information Technologies and Robotics, Information Technology Software (Software engineer) / Minsk, Belarus',
            'SKILLS' => json_encode(['Python', 'Django', 'TDD', 'HTML / CSS, Bootstrap', 'Docker']),
            'LANGUAGES' => json_encode(['english', 'russian', 'german']),
            'ACTIVE' => 1,
            'ABOUT_ME' => 'I prefer a healthy lifestyle like traveling, play basketball and football, and so on.
                            I like to watch movies and series.
                            I am free of the bad habits.
                            I like to learn new technologies. Motivated to learn.
                            I am responsible and initiative.',
        ]);
        $category = JobCategories::where('NAME', 'javascript')->firstOrFail();
        User::create([
            'NAME' => 'Alexander',
            'ICON' => Constants::DEMO_ICONS[2],
            'IMAGE' => Constants::DEMO_IMAGES['candidate-alexander'],
            'EMAIL' => 'mr-freeman89@mail.ru',
            'PHONE' => '+49715811132',
            'password' => bcrypt('almaz'),
            'role_id' => $roleCandidate->id,
            'COUNTRY' => 'Ukraine',
            'CITY' => 'Kiev',
            'CATEGORY_ID' => $category->ID,
            'LEVEL' => 'Middle',
            'YEARS_EXPERIENCE' => '4',
            'SALARY' => 2500,
            'EXPERIENCE' => 'System integration, automation of technological and business processes of an enterprise, IT consulting',
            'EDUCATION' => 'BNTU. Computer hardware and automated systems software',
            'SKILLS' => json_encode(['JavaScript', 'HTML5', 'CSS3', 'Git', 'React', 'MongoDB']),
            'LANGUAGES' => json_encode(['english', 'russian']),
            'ACTIVE' => 1,
            'ABOUT_ME' => 'Fast learner, assiduous, sociable, able to work in a team, ambitious, as well as striving to improve his theoretical and practical skills.',
        ]);

        //COMPANIES
        User::create([
            'NAME' => 'Giperlink',
            'ICON' => Constants::DEMO_ICONS[0],
            'IMAGE' => Constants::DEMO_IMAGES['companies-giperlink'],
            'EMAIL' => 'Giperlink@test.com',
            'PHONE' => '+49765821155',
            'password' => bcrypt('almaz'),
            'role_id' => $roleCompany->id,
            'COUNTRY' => 'Belarus',
            'CITY' => 'Minsk',
            'EMPLOYEE_CNT' => 20,
            'WEB_SITE' => 'https://giperlink.by/',
            'ACTIVE' => 1,
            'DESCRIPTION' => 'We develop websites based on the study of consumer experience, web analytics and testing. We know e-commerce from the inside - the company\'s management created and managed the Silverado online store. We are committed to long-term cooperation: we support and develop projects, help to increase conversion.',
        ]);
        User::create([
            'NAME' => 'EPAM',
            'ICON' => Constants::DEMO_ICONS[1],
            'IMAGE' => Constants::DEMO_IMAGES['companies-epam'],
            'EMAIL' => 'EPAM@test.com',
            'PHONE' => '+49725811355',
            'password' => bcrypt('almaz'),
            'role_id' => $roleCompany->id,
            'COUNTRY' => 'Belarus',
            'CITY' => 'Minsk',
            'EMPLOYEE_CNT' => 100333,
            'WEB_SITE' => 'https://www.epam.com/',
            'ACTIVE' => 1,
            'DESCRIPTION' => 'We can help you reimagine your business through a digital lens. Our software engineering heritage combined with our strategic business and innovation consulting, design thinking, and physical-digital capabilities provide real business value to our customers through human-centric innovation.',
        ]);
        User::create([
            'NAME' => 'iTechArt',
            'ICON' => Constants::DEMO_ICONS[2],
            'IMAGE' => Constants::DEMO_IMAGES['companies-itechart'],
            'EMAIL' => 'iTechArt@test.com',
            'PHONE' => '+49715821155',
            'password' => bcrypt('almaz'),
            'role_id' => $roleCompany->id,
            'COUNTRY' => 'Belarus',
            'CITY' => 'Minsk',
            'EMPLOYEE_CNT' => 2400,
            'WEB_SITE' => 'https://www.itechart.by/',
            'ACTIVE' => 1,
            'DESCRIPTION' => 'iTechArt is 19+ successful years in the IT development, testing and consulting market. These are top clients from the USA and Western Europe. This is a wide technology stack and projects for various industries.',
        ]);
        User::create([
            'NAME' => 'Belhard',
            'ICON' => Constants::DEMO_ICONS[2],
            'IMAGE' => Constants::DEMO_IMAGES['companies-belhard'],
            'EMAIL' => 'Belhard@test.com',
            'PHONE' => '+49215851155',
            'password' => bcrypt('almaz'),
            'role_id' => $roleCompany->id,
            'COUNTRY' => 'Belarus',
            'CITY' => 'Minsk',
            'EMPLOYEE_CNT' => 10500,
            'WEB_SITE' => 'https://www.belhard.com/',
            'ACTIVE' => 1,
            'DESCRIPTION' => 'The group of companies "BelHard" is a modern approach to solving the most complex problems in the IT field, it is an efficient solution of issues, complex unique technological developments. Everyone who cooperates with Belhard was able to discover their abilities, see the ways of their development and reach heights. We help to do business, build a career, gain knowledge, so that tomorrow is always better than today. The enterprises of the BelHard Holding are part of the scientific and technological association Infopark (CJSC BelHard Group has been a resident of Infopark since December 13, 2002, by the decision of the Association Council); Park of High Technologies (LLC "BelHard Development" - since February 19, 2007, certificate No. 0000018).',
        ]);
        User::create([
            'NAME' => 'Techin',
            'ICON' => Constants::DEMO_ICONS[4],
            'IMAGE' => Constants::DEMO_IMAGES['companies-techin'],
            'EMAIL' => 'Techin@test.com',
            'PHONE' => '+49615813155',
            'password' => bcrypt('almaz'),
            'role_id' => $roleCompany->id,
            'COUNTRY' => 'Belarus',
            'CITY' => 'Minsk',
            'EMPLOYEE_CNT' => 50,
            'WEB_SITE' => 'http://www.techin.by/',
            'ACTIVE' => 1,
            'DESCRIPTION' => 'We are working to help you become more successful by automating the processes of redistributing the freed up time resource to create new and necessary benefits for people and society.',
        ]);
    }
}
