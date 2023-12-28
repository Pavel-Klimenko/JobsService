<?php

//namespace Database\Seeders;

use App\Models\Reviews;
use App\Domains\Candidates\Models\User;
use App\Domains\Vacancies\Models\Vacancies;
use Illuminate\Database\Seeder;
use App\Domains\Candidates\Models\JobCategories;



use App\Constants;

class VacanciesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        //TODO оптимизировать код! убрать дубли! Сделать фабрики!!!!

        $category = DB::table('job_categories')->where('NAME', 'PHP')->first();
        $company = DB::table('users')->where('NAME', 'Giperlink')->first();

        Vacancies::create([
            'NAME' => 'PHP Developer',
            'ICON' => Constants::DEMO_ICONS[0],
            'IMAGE' => Constants::DEMO_IMAGES['companies-giperlink'],
            'COUNTRY' => 'Belarus',
            'CITY' => 'Minsk',
            'CATEGORY_ID' => $category->ID,
            'COMPANY_ID' => $company->id,
            'SALARY_FROM' => 500,
            'ACTIVE' => 1,
            'DESCRIPTION' => 'Our customer is a leading international tobacco company headquartered in Switzerland. Its 400 offices, 27 factories, 5 research centers, and 5 tobacco processing enterprises are located across the globe. Over the past 7 years, the company has been certified as the best employer in the world, and in 2021, it received regional certifications in the Asia-Pacific region, Europe, North America, Africa, the Middle East, and Latin America.',
            'RESPONSIBILITY' => json_encode([
                'Conducting analysis of website and application requirements.',
                'Writing back-end code and building efficient PHP modules.',
                'Finalizing back-end features and testing web applications.',
                'Updating and altering application features to enhance performance.',
            ]),
            'QUALIFICATIONS'=> json_encode([
                '6 or more years of commercial PHP development experience',
                'Experience with PHP frameworks Symfony or Laravel (preferred)',
                'Knowledge of SDLC',
                'Experience with Git and CI/CD integration',
                'Experience in building REST services'
            ]),
            'BENEFITS' => 'Fringe benefits are a variety of non-cash payments are used to attract and retain talented employees. They may include tuition assistance, flexible medical or child-care spending accounts (pre-tax accounts to pay qualified expenses), other child-care benefits, and non-production bonuses (bonuses not tied to performance).',
        ]);

        $category = DB::table('job_categories')->where('NAME', 'java')->first();
        $company = DB::table('users')->where('NAME', 'EPAM')->first();
        Vacancies::create([
            'NAME' => 'Middle Java developer',
            'ICON' => Constants::DEMO_ICONS[1],
            'IMAGE' => Constants::DEMO_IMAGES['companies-epam'],
            'COUNTRY' => 'Belarus',
            'CITY' => 'Minsk',
            'CATEGORY_ID' => $category->ID,
            'COMPANY_ID' => $company->id,
            'SALARY_FROM' => 1500,
            'ACTIVE' => 1,
            'DESCRIPTION' => 'We are looking for highly skilled programmers with experience building web applications in Java. Java Developers are responsible for analyzing user requirements and business objectives, determining application features and functionality, and recommending changes to existing Java-based applications, among other duties.',
            'RESPONSIBILITY' => json_encode([
                'Designing and implementing Java-based applications.',
                'Analyzing user requirements to inform application design.',
                'Defining application objectives and functionality.',
                'Developing multimedia applications.'
            ]),
            'QUALIFICATIONS'=> json_encode([
                'Degree in Computer Science or related field.',
                '1 year or more experience in commercial Java development using Spring',
                'Experience with React.js or Vue.js, Angular will be a plus.'
            ]),
            'BENEFITS' => 'Fringe benefits are a variety of non-cash payments are used to attract and retain talented employees. They may include tuition assistance, flexible medical or child-care spending accounts (pre-tax accounts to pay qualified expenses), other child-care benefits, and non-production bonuses (bonuses not tied to performance).',
        ]);


        $category = DB::table('job_categories')->where('NAME', 'swift')->first();
        $company = DB::table('users')->where('NAME', 'EPAM')->first();

        Vacancies::create([
            'NAME' => 'Middle Swift developer',
            'ICON' => Constants::DEMO_ICONS[4],
            'IMAGE' => Constants::DEMO_IMAGES['companies-epam'],
            'COUNTRY' => 'Belarus',
            'CITY' => 'Minsk',
            'CATEGORY_ID' => $category->ID,
            'COMPANY_ID' => $company->id,
            'SALARY_FROM' => 2500,
            'ACTIVE' => 1,
            'DESCRIPTION' => 'We are looking for a Swift Developer to join our team! As a Swift Developer you will be responsible for the development and maintenance of applications aimed towards iOS and OS X. You will oversee development of applications and their integration with back-end services.',
            'RESPONSIBILITY' => json_encode([
                'Plan, design and implement applications for iOS and OS X',
                'Monitor the performance, quality, and responsiveness of company\'s applications',
                'Identify process bottlenecks',
                'Find and fix bugs in a timely manner'
            ]),
            'QUALIFICATIONS'=> json_encode([
                'Proficiency in Swift',
                'X years of experience as a Swift Developer or similar role',
                'Knowledge of RESTful APIs to connect to back-end services',
                'Critical thinker and problem-solving skills'
            ]),
            'BENEFITS' => 'Fringe benefits are a variety of non-cash payments are used to attract and retain talented employees. They may include tuition assistance, flexible medical or child-care spending accounts (pre-tax accounts to pay qualified expenses), other child-care benefits, and non-production bonuses (bonuses not tied to performance).',
        ]);

        $category = DB::table('job_categories')->where('NAME', 'go')->first();
        $company = DB::table('users')->where('NAME', 'EPAM')->first();

        Vacancies::create([
            'NAME' => 'Junior Go developer',
            'ICON' => Constants::DEMO_ICONS[2],
            'IMAGE' => Constants::DEMO_IMAGES['companies-epam'],
            'COUNTRY' => 'Ukraine',
            'CITY' => 'Kharkov',
            'CATEGORY_ID' => $category->ID,
            'COMPANY_ID' => $company->id,
            'SALARY_FROM' => 400,
            'ACTIVE' => 1,
            'DESCRIPTION' => 'Become a part of the bigger picture and get ready to make important contributions to the development of innovative solutions.
                                To build a quality and comprehensive error-free technology infrastructure, establish and maintain an effective operational environment with 99.99% run time, and deliver quality, prompt, cost-effective, and reliable technology services to serve the best impossible experience for customers.',
            'RESPONSIBILITY' => json_encode([
                'To cooperate with other stakeholder to design, develop, test, release and improve services',
                'Maintain development standards, practices & principles',
                'Build scalable and maintainable software'
            ]),
            'QUALIFICATIONS'=> json_encode([
                'At least 1 year of experience with Golang.',
                'Have expertise in implementing micro services (using tools and technologies for messaging, RPC, containerization, etc.)',
                'Basic experience working with AWS/Google Cloud'
            ]),
            'BENEFITS' => 'Fringe benefits are a variety of non-cash payments are used to attract and retain talented employees. They may include tuition assistance, flexible medical or child-care spending accounts (pre-tax accounts to pay qualified expenses), other child-care benefits, and non-production bonuses (bonuses not tied to performance).',
        ]);

        $category = DB::table('job_categories')->where('NAME', 'ruby')->first();
        $company = DB::table('users')->where('NAME', 'iTechArt')->first();

        Vacancies::create([
            'NAME' => 'Senior Ruby developer',
            'ICON' => Constants::DEMO_ICONS[2],
            'IMAGE' => Constants::DEMO_IMAGES['companies-itechart'],
            'COUNTRY' => 'USA',
            'CITY' => 'Boston',
            'CATEGORY_ID' => $category->ID,
            'COMPANY_ID' => $company->id,
            'SALARY_FROM' => 5500,
            'ACTIVE' => 1,
            'DESCRIPTION' => 'We’re looking for an experienced Developer with in-depth experience in Ruby on Rails who will join our team of exceptional developers working in a fast-paced environment to deliver world-class software.',
            'RESPONSIBILITY' => json_encode([
                'Develop robust٫ scalable and secure features',
                'Write clean٫ maintainable and efficient code',
                'Stay informed about relevant new technologies and drive their continuous adoption and integration into design'
            ]),
            'QUALIFICATIONS'=> json_encode([
                '2+ years\' experience of working on a Ruby on Rails Developer position',
                'Profound experience with front-end technologies such as JavaScript٫ HTML٫ CSS and JQuery',
                'Good experience with relational and NoSQL databases'
            ]),
            'BENEFITS' => 'Fringe benefits are a variety of non-cash payments are used to attract and retain talented employees. They may include tuition assistance, flexible medical or child-care spending accounts (pre-tax accounts to pay qualified expenses), other child-care benefits, and non-production bonuses (bonuses not tied to performance).',
        ]);

        $category = DB::table('job_categories')->where('NAME', 'javascript')->first();
        $company = DB::table('users')->where('NAME', 'iTechArt')->first();

        Vacancies::create([
            'NAME' => 'Front-end developer',
            'ICON' => Constants::DEMO_ICONS[3],
            'IMAGE' => Constants::DEMO_IMAGES['companies-itechart'],
            'COUNTRY' => 'Russia',
            'CITY' => 'Moscow',
            'CATEGORY_ID' => $category->ID,
            'COMPANY_ID' => $company->id,
            'SALARY_FROM' => 1200,
            'ACTIVE' => 1,
            'DESCRIPTION' => 'We are in search of a JavaScript developer to join the fun, using advanced JavaScript, CSS, and React to optimize design, performance, and quality, while continuously evolving our technology stack. Day to day, you will be responsible for all front end aspects, from designing complex applications to ensuring a positive user experience by analyzing code. Our ideal candidate has an eye for design and the ability to create clean, sharp, and responsive layouts from designs with HTML5, CSS3, and JavaScript.',
            'RESPONSIBILITY' => json_encode([
                'Write, modify, and debug web applications using Node.js, JavaScript, HTML and CSS',
                'Design, code, and manage automated test scripts, continuous builds, and deployment',
                'Self-document development processes, conduct peer reviews, and give actionable feedback'
            ]),
            'QUALIFICATIONS'=> json_encode([
                '3+ years of experience with HTML/CSS/JavaScript and JavaScript Frameworks such as JQuery',
                'Knowledge of client-side single-page applications using modern frameworks like React'
            ]),
            'BENEFITS' => 'Fringe benefits are a variety of non-cash payments are used to attract and retain talented employees. They may include tuition assistance, flexible medical or child-care spending accounts (pre-tax accounts to pay qualified expenses), other child-care benefits, and non-production bonuses (bonuses not tied to performance).',
        ]);

        $category = DB::table('job_categories')->where('NAME', 'python')->first();
        $company = DB::table('users')->where('NAME', 'Techin')->first();

        Vacancies::create([
            'NAME' => 'Python developer',
            'ICON' => Constants::DEMO_ICONS[4],
            'IMAGE' => Constants::DEMO_IMAGES['companies-techin'],
            'COUNTRY' => 'Belarus',
            'CITY' => 'Minsk',
            'CATEGORY_ID' => $category->ID,
            'COMPANY_ID' => $company->id,
            'SALARY_FROM' => 1000,
            'ACTIVE' => 1,
            'DESCRIPTION' => 'We are looking for an experienced Python developer to join our engineering team and help us create dynamic software applications for our clients. In this role, you will be responsible for writing and testing scalable code, developing back-end components, and integrating user-facing elements in collaboration with front-end developers.',
            'RESPONSIBILITY' => json_encode([
                'Coordinating with development teams to determine application requirements.',
                'Writing scalable code using Python programming language.',
                'Developing back-end components.',
                'Developing digital tools to monitor online traffic.'
            ]),
            'QUALIFICATIONS'=> json_encode([
                '3-5 years of experience as a Python developer.',
                'A deep understanding and multi-process architecture and the threading limitations of Python.',
                'Ability to collaborate on projects and work independently when required.'
            ]),
            'BENEFITS' => 'Fringe benefits are a variety of non-cash payments are used to attract and retain talented employees. They may include tuition assistance, flexible medical or child-care spending accounts (pre-tax accounts to pay qualified expenses), other child-care benefits, and non-production bonuses (bonuses not tied to performance).',
        ]);
    }
}
