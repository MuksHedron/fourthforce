<style>
    .fontsize20 {
        font-size: 20px !important;
    }

    thead,
    tbody,
    tfoot,
    tr,
    td,
    th {
        border-color: inherit;
        border-style: solid;
        border-width: .5px !important;

    }
</style>



<div class="row-fluid">

    <div class="span12 text-center text-decoration-underline fontsize20">
        Post Issuance Profile Verification
    </div>

</div>

<div class="row-fluid">

    <div class="span12 text-center fontsize20">
        Name of the Investigating Agency – Fourth Force Surveillance Indo Pvt. Ltd.
    </div>

</div>



<table class="table table-bordered border-primary">
    <tbody>

        <tr>
            <td class="fw-bold">{{$file->lbllookups->tag ?? ''}}</td>
            <td>{{$file->policyno ?? ''}}</td>
        </tr>

        <tr>
            <td class="fw-bold">Name of Life Assured</td>
            <td>{{$file->name ?? ''}}</td>
        </tr>
        <tr>
            <td class="fw-bold">Father’s/Husband’s Name</td>
            <td>{{$file->fathername ?? ''}}</td>
        </tr>
        <tr>
            <td class="fw-bold">Date of Birth</td>
            <td>{{$file->dob ?? ''}}</td>
        </tr>
        <tr>
            <td class="fw-bold">Current Address</td>
            <td>{{$file->address ?? ''}}</td>
        </tr>
        <tr>
            <td class="fw-bold">Contact No</td>
            <td>{{$file->mobile1 ?? ''}} / {{$file->mobile2 ?? ''}}</td>
        </tr>
        <tr>
            <td class="fw-bold">If Contact No or Address Changed</td>
            <td>{{$file->address ?? ''}}</td>
        </tr>
        <tr>
            <td class="fw-bold">Occupation</td>
            <td>{{$report->empcategory ?? ''}}</td>
        </tr>
        <tr>
            <td class="fw-bold">Name of Nominee and Relationship</td>
            <td>{{$file->nominiee ?? ''}}</td>
        </tr>


        <tr>
            <td colspan="2" class="fw-bold text-center table-active"> If Life Assured Met No</td>
        </tr>
        <tr>
            <td class="fw-bold">If Met, photograph taken Yes/No</td>
            <td>{{$report->ismeet ?? 'No'}}</td>
        </tr>
        <tr>
            <td class="fw-bold">Is Photograph Geo Tagged Yes/No</td>
            <td>{{$report->idproof ?? 'No'}}</td>
        </tr>

        <tr>
            <td class="fw-bold">If Not, IO met whom</td>
            <td>Nominee - {{$report->whommeet ?? ''}}</td>
        </tr>
        <tr>
            <td class="fw-bold"></td>
            <td>Family Members - {{$report->whommeet ?? ''}}</td>
        </tr>
        <tr>
            <td class="fw-bold"></td>
            <td>Neighbors - {{$report->whommeet ?? ''}}</td>
        </tr>
        <tr>
            <td class="fw-bold"></td>
            <td>Office Staff - [Not Applicable]</td>
        </tr>
        <tr>
            <td class="fw-bold"></td>
            <td>Local People - [Not Applicable]</td>
        </tr>
        <tr>
            <td class="fw-bold">Health Condition of LA “Fit & Fine”</td>
            <td>{{$report->condition ?? 'NA'}} </td>
        </tr>
        <tr>
            <td class="fw-bold">If No DM/HTN/others</td>
            <td>[Not Applicable] </td>
        </tr>

        <tr>
            <td class="fw-bold">If Other mentioned brief details</td>
            <td>NA</td>
        </tr>

        <tr>
            <td class="fw-bold">KYC document collected</td>
            <td>NA</td>
        </tr>

        <tr>
            <td class="fw-bold">Age Discrepancy Noted</td>
            <td>No</td>
        </tr>

        <tr>
            <td class="fw-bold">If Yes – Evidence Procured</td>
            <td>Not Applicable</td>
        </tr>
        <tr>
            <td class="fw-bold">Vicinity Checks/Findings</td>
            <td>Further investigation we did the nearby neighbor Mr. {{$report->neighbourname ?? 'NA'}} confirmed La stays in that address , {{$report->neighbourmobile ?? 'Not revealed their contact number'}} .</td>
        </tr>


        <tr>
            <td colspan="2" class="fw-bold text-center table-active"> If Life Assured’s address is Untraceable -Yes</td>
        </tr>
        <tr>
            <td class="fw-bold">LA contacted through Mobile no.</td>
            <td>Yes</td>
        </tr>
        <tr>
            <td class="fw-bold">If Yes - Health Condition of LA “Fit & Fine”</td>
            <td>{{$report->condition}}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td class="fw-bold">If No – Mentioned reason</td>
            <td>Not reachable - [Not Applicable]</td>
        </tr>
        <tr>
            <td class="fw-bold"></td>
            <td>Switched off- [Not Applicable]</td>
        </tr>
        <tr>
            <td class="fw-bold"></td>
            <td>Wrong No- [Not Applicable]</td>
        </tr>
        <tr>
            <td class="fw-bold"></td>
            <td>Not Responding - Yes</td>
        </tr>


        <tr>
            <td colspan="2" class="fw-bold text-center table-active"> If Life Assured Found Died- NA</td>
        </tr>
        <tr>
            <td class="fw-bold">Date of Death</td>
            <td>[Not Applicable] </td>
        </tr>
        <tr>
            <td class="fw-bold">Death Certificate Received Yes/No</td>
            <td>[Not Applicable] </td>
        </tr>
        <tr>
            <td class="fw-bold">If No : List of Supporting Documents</td>
            <td>Cremation Certificate -[Not Applicable]</td>
        </tr>
        <tr>
            <td class="fw-bold"></td>
            <td>Gram Panchayat Certificate -[Not Applicable]</td>
        </tr>
        <tr>
            <td class="fw-bold"></td>
            <td>Doctor Certificate -[Not Applicable]</td>
        </tr>
        <tr>
            <td class="fw-bold"></td>
            <td>Other-[Not Applicable]</td>
        </tr>

        <tr>
            <td colspan="2" class="fw-bold text-center table-active"> Social media checks: Yes</td>
        </tr>
        <tr>
            <td class="fw-bold">Social media checks:</td>
            <td>Facebook – [Not Found on Face Book]</td>
        </tr>
        <tr>
            <td class="fw-bold"></td>
            <td>WhatsApp- Done</td>
        </tr>
        <tr>
            <td class="fw-bold"></td>
            <td>True caller- Done</td>
        </tr>


        <tr>
            <td colspan="2" class="fw-bold text-center table-active"> Any special findings</td>
        </tr>

        <tr>
            <td colspan="2">On Dated 9-12-2021 Our Executive visited the provided address of LA for verification. Met with LA, LA’s occupation RTC assistant clerk, Annual income 2 lakhs per annum, Nominee name Uma Devi –Wife, He refused to share Aadhaar card , Further investigation we did the nearby neighbor check Mr.Shivaram they said that they are not aware of such person. Neighbors did not revealed their contact number. We have taken La photo nearby area photo with GPS tagging.</td>
        </tr>


        <tr>
            <td colspan="2" class="fw-bold text-center table-active"> Conclusion of PIPV</td>
        </tr>
        <tr>
            <td colspan="2">Traceable
            </td>
        </tr>

    </tbody>

</table>
<div>
    <p class="fw-bold">Enclosures:</p>

    <ul>
        <li class="fw-bold"> LA Online True caller Verification</li>
        <li class="fw-bold">LA house nearby area location Photo with GPS Tagging </li>
    </ul>

    <p class="fw-bold" style="margin-left: 33px;">DECLARATION:</p>

    <p style="margin-left: 33px;">
        I hereby declare that the foregoing statements and information have been given by me after full verifications and the same are true and complete in every manner to the best of my knowledge. Further, I have not provided any false information. I have verified that this report is filled completely in all respects and that all required documents are attached along with the Report.
    </p>

    <p class="fw-bold" style="margin-left: 33px;">
        Name of the Field Investigator – Fourth Force Surveillance Indo Pvt. Ltd.
    </p>

    <p class="fw-bold" style="margin-left: 33px;">
        Contact No of the field Investigator – 7825001276
    </p>

    <p style="margin-left: 33px;">
        Place – Hyderabad
    </p>
    <p style="margin-left: 33px;">
        Date–28-06-2021
    </p>

</div>