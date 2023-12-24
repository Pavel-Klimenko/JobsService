<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Containers\Candidates\Actions;

use App\Models\User;
use App\Ship\Helpers\Helper;
use App\Containers\Vacancies\Models\JobCategories;

class getCandidateView
{
    public function run($candidate) {

        $isCompanyFlag = Helper::isCompany();
        $isCandidate = Helper::isCandidate();
        $category = Helper::getTableRow(JobCategories::class, 'ID', $candidate->CATEGORY_ID);

        if ($isCompanyFlag) {
            $company = auth()->user();
            $companyVacancies = User::find($company->id)->vacancies;

            $invitations = User::find($company->id)
                ->allAdvices()
                ->where('CANDIDATE_ID', $candidate->id)
                ->first();

            $view = view('detail_pages.candidate', compact('candidate', 'category', 'isCompanyFlag', 'companyVacancies', 'invitations'));
        } elseif ($isCandidate) {
            $view = view('detail_pages.candidate', compact('candidate', 'category', 'isCompanyFlag'));
        } else {
            $view = view('detail_pages.candidate', compact('candidate', 'category'));

        }

        return $view;
    }

}