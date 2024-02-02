<?php
//namespace Database\Seeders;

use App\Domains\Candidates\Models\InterviewInvitations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class InvitationsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {


        $company = DB::table('users')->where('NAME', 'EPAM')->first();

        InterviewInvitations::create(
            [
                'COMPANY_ID' => DB::table('users')->where('NAME', 'EPAM')->first()->id,
                'CANDIDATE_ID' => DB::table('users')->where('NAME', 'Pavel')->first()->id,
                'VACANCY_ID' => DB::table('vacancies')->where('COMPANY_ID', $company->id)->first()->id,
                'STATUS' => 'accepted',
            ]);


        InterviewInvitations::create(
            [
                'COMPANY_ID' => $company->id,
                'CANDIDATE_ID' => DB::table('users')->where('NAME', 'Olga')->first()->id,
                'VACANCY_ID' => DB::table('vacancies')->where('COMPANY_ID', $company->id)->first()->id,
                'STATUS' => 'rejected',
            ]);


        InterviewInvitations::create(
            [
                'COMPANY_ID' => $company->id,
                'CANDIDATE_ID' => DB::table('users')->where('NAME', 'Victor')->first()->id,
                'VACANCY_ID' => DB::table('vacancies')->where('COMPANY_ID', $company->id)->first()->id,
                'CANDIDATE_COVERING_LETTER' => 'It has survived not only five centuries,
                     but also the leap into electronic typesetting, remaining essentially unchanged.
                     It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                     and more recently
                     with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'STATUS' => 'no_status',
            ]);

        InterviewInvitations::create(
            [
                'COMPANY_ID' => $company->id,
                'CANDIDATE_ID' => DB::table('users')->where('NAME', 'iTechArt')->first()->id,
                'VACANCY_ID' => DB::table('vacancies')->where('COMPANY_ID', $company->id)->first()->id,
                'STATUS' => 'accepted',
            ]);

        InterviewInvitations::create(
            [
                'COMPANY_ID' => $company->id,
                'CANDIDATE_ID' => DB::table('users')->where('NAME', 'Giperlink')->first()->id,
                'VACANCY_ID' => DB::table('vacancies')->where('COMPANY_ID', $company->id)->first()->id,
                'STATUS' => 'rejected',
            ]);

        InterviewInvitations::create([
                'COMPANY_ID' => $company->id,
                'CANDIDATE_ID' => DB::table('users')->where('NAME', 'Techin')->first()->id,
                'VACANCY_ID' => DB::table('vacancies')->where('COMPANY_ID', $company->id)->first()->id,
                'CANDIDATE_COVERING_LETTER' => 'It has survived not only five centuries,
                     but also the leap into electronic typesetting, remaining essentially unchanged.
                     It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                     and more recently
                     with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'STATUS' => 'no_status',
            ]);
    }
}
