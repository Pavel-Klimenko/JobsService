<?php
//namespace Database\Seeders;

use App\Domains\Candidates\Models\InterviewInvitations;
use App\Domains\Candidates\Models\User;
use App\Domains\Vacancies\Models\Vacancies;
use App\Constants;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class InvitationsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {

        //TODO оптимизировать код! убрать дубли! Сделать фабрики!!!!

        $candidate = DB::table('users')->where('NAME', 'Pavel')->first();
        $company = DB::table('users')->where('NAME', 'EPAM')->first();
        $vacancy = DB::table('vacancies')->where('COMPANY_ID', $company->id)->first();


        InterviewInvitations::create(
            [
                'COMPANY_ID' => $company->id,
                'CANDIDATE_ID' => $candidate->id,
                'CANDIDATE_NAME' => $candidate->NAME,
                'VACANCY_ID' => $vacancy->ID,
                'VACANCY_NAME' => $vacancy->NAME,
                'STATUS' => Constants::INTERVIEW_ADVICES_STATUSES['ACCEPTED'],
            ]);


        $candidate = DB::table('users')->where('NAME', 'Olga')->first();
        $vacancy = DB::table('vacancies')->where('COMPANY_ID', $company->id)->first();



        InterviewInvitations::create(
            [
                'COMPANY_ID' => $company->id,
                'CANDIDATE_ID' => $candidate->id,
                'CANDIDATE_NAME' => $candidate->NAME,
                'VACANCY_ID' => $vacancy->ID,
                'VACANCY_NAME' => $vacancy->NAME,
                'STATUS' => Constants::INTERVIEW_ADVICES_STATUSES['REJECTED'],
            ]);

/*        $candidate = User::where('NAME', 'Victor')->firstOrFail();
        $vacancy = Vacancies::where('COMPANY_ID', $company->id)->firstOrFail();*/

        $candidate = DB::table('users')->where('NAME', 'Victor')->first();
        $vacancy = DB::table('vacancies')->where('COMPANY_ID', $company->id)->first();

        InterviewInvitations::create(
            [
                'COMPANY_ID' => $company->id,
                'CANDIDATE_ID' => $candidate->id,
                'CANDIDATE_NAME' => $candidate->NAME,
                'VACANCY_ID' => $vacancy->ID,
                'VACANCY_NAME' => $vacancy->NAME,
                'CANDIDATE_COVERING_LETTER' => 'It has survived not only five centuries,
                     but also the leap into electronic typesetting, remaining essentially unchanged.
                     It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                     and more recently
                     with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'STATUS' => Constants::INTERVIEW_ADVICES_STATUSES['NO_STATUS'],
            ]);

        $candidate = DB::table('users')->where('NAME', 'iTechArt')->first();
        $vacancy = DB::table('vacancies')->where('COMPANY_ID', $company->id)->first();

        InterviewInvitations::create(
            [
                'COMPANY_ID' => $company->id,
                'CANDIDATE_ID' => $candidate->id,
                'CANDIDATE_NAME' => $candidate->NAME,
                'VACANCY_ID' => $vacancy->ID,
                'VACANCY_NAME' => $vacancy->NAME,
                'STATUS' => Constants::INTERVIEW_ADVICES_STATUSES['ACCEPTED'],
            ]);


        $candidate = DB::table('users')->where('NAME', 'Giperlink')->first();
        $vacancy = DB::table('vacancies')->where('COMPANY_ID', $company->id)->first();

        InterviewInvitations::create(
            [
                'COMPANY_ID' => $company->id,
                'CANDIDATE_ID' => $candidate->id,
                'CANDIDATE_NAME' => $candidate->NAME,
                'VACANCY_ID' => $vacancy->ID,
                'VACANCY_NAME' => $vacancy->NAME,
                'STATUS' => Constants::INTERVIEW_ADVICES_STATUSES['REJECTED'],
            ]);

        $candidate = DB::table('users')->where('NAME', 'Techin')->first();
        $vacancy = DB::table('vacancies')->where('COMPANY_ID', $company->id)->first();

        InterviewInvitations::create(
            [
                'COMPANY_ID' => $company->id,
                'CANDIDATE_ID' => $candidate->id,
                'CANDIDATE_NAME' => $candidate->NAME,
                'VACANCY_ID' => $vacancy->ID,
                'VACANCY_NAME' => $vacancy->NAME,
                'CANDIDATE_COVERING_LETTER' => 'It has survived not only five centuries,
                     but also the leap into electronic typesetting, remaining essentially unchanged.
                     It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                     and more recently
                     with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'STATUS' => Constants::INTERVIEW_ADVICES_STATUSES['NO_STATUS'],
            ]);
    }
}
