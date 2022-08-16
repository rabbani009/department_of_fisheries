<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fishers ID Card</title>

    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 62.5%;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Hind Siliguri', sans-serif;
            text-rendering: optimizeLegibility;
            line-height: 1.3rem;
            font-size: 1.6rem;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Reusable */
        .fw-bold {
            font-weight: 600 !important;
        }

        .mb-1 {
            margin-bottom: 1rem;
        }

        .mb-2 {
            margin-bottom: 2rem;
        }

        .lead {
            font-size: 1.4rem;
            line-height: normal;
            font-weight: 500;
            margin-bottom: 1rem;
            height: 55px !important;
        }

        .lead-1 {
            font-size: 1.4rem;
            line-height: normal;
            color: #000;
        }
        .text-center {
            text-align: center;
        }
        .fw-bold {
            font-weight: 600 !important;
        }

        .mb-2 {
            margin-bottom: 2rem;
        }

        .p-4 {
            padding: 4rem;
        }


        .container {
            max-width: 62rem;
            width: 100%;
            margin: 3rem auto;
        }

        .container-inner {
            background: url("{{ asset('/') }}id-card/1.png") no-repeat center center;
            background-size: cover;
            min-height: 40rem;
            position: relative;
        }

        .container-inner-back {
            background: url("{{ asset('/') }}id-card/2.png") no-repeat center center;
            background-size: cover;
            min-height: 40rem;
            position: relative;
        }

        .content-wrapper {}

        .issued-date {
            position: absolute;
            top: 19%;
            left: calc(50% - 6.0rem)
        }

        .issued-date small {
            font-size: 1.4rem;
            line-height: normal;
        }

        .main-content {
            position: absolute;
            top: 35%;
            left: 0;
            width: 100%;
            padding: .6rem 4rem;
        }

        .card-holder-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-holder-info-left {
            /*width: 50%;*/
            flex-grow: 1;
        }
        .field {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            font-size: 1.6rem;
            line-height: normal;
            font-weight: 500;
        }

        .field-name {
            width: 30%;
        }
        .field-value {
            width: 70%;
        }

        .card-holder-info-right {
            /*width: 50%;*/
        }
        .avatar {
            text-align: right;
        }
        .avatar img {
            width: 14.0rem;
            height: 14.0rem;
            border: .3rem solid #fff;
            border-radius: .8rem;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-left {
            width: 50%;
        }

        .sign {
            width: 50%;
            display: flex;
            align-items: flex-end;
            flex-direction: column-reverse;
            position: relative;
        }

        .signature-img {
            width: 50%;
            position: absolute;
            top: -50px;
            left: calc(50% - 12px);
        }

        .sign small {
            padding-right: 2rem;
        }

        /* Reusable */

        .container {
            max-width: 62rem;
            width: 100%;
            margin: 3rem auto;
        }

        .qr-code img {
            width: 14.0rem;
            height: 14.0rem;
            border-radius: .4rem;
        }

        .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-left {
            width: 50%;
        }

        .card-right {
            width: 50%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="container-inner">
            <div class="content-wrapper">
                <div class="issued-date">
                    <small class="lead-1 fw-bold">Issued on: 01 Jun 2022</small>
                </div>
                <div class="main-content">
                    <div class="card-holder-info">
                        <div class="card-holder-info-left">
                            <div class="field fw-bold mb-2">
                                <div class="field-name">FID NO</div>
                                <div class="field-value">: {{ $data->fId ?? '' }}</div>
                            </div>

                            <div class="field">
                                <div class="field-name">নাম</div>
                                <div class="field-value">: {{ $data->fishermanNameBng ?? '' }}</div>
                            </div>

                            <div class="field fw-bold">
                                <div class="field-name">Name</div>
                                <div class="field-value">: {{ $data->fishermanNameEng ?? '' }}</div>
                            </div>

                            <div class="field">
                                <div class="field-name">পিতার নাম</div>
                                <div class="field-value">: {{ $data->fathersName ?? '' }}</div>
                            </div>

                            <div class="field mb-2">
                                <div class="field-name">মাতার নাম</div>
                                <div class="field-value">: {{ $data->mothersName ?? '' }}</div>
                            </div>

                            <div class="field fw-bold mb-1">
                                <div class="field-name">Date of Birth</div>
                                <div class="field-value">: {{ date('d M Y', strtotime($data->dateOfBirth)) }}</div>
                            </div>

                        </div>

                        <div class="card-holder-info-right">
                            <div class="avatar mb-2">
                                <img src="{{ asset('/') }}id-card/card-holder.jpg" alt="Card holder">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="footer-left">
                            <small class="lead-1 fw-bold">The Holder is a Fisherman of Bangladesh</small>
                        </div>

                        <div class="sign">
                            <small class="lead-1 fw-bold">Director General</small>
                            <img class="signature-img" src="{{ asset('/') }}id-card/signature.png" alt="Signature director of general">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="container-inner-back">
            <div class="id-card p-4">
                <div class="card-header text-center mb-2">
                    <p class="lead">এই কার্ডটি গণপ্রজাতন্ত্রী বাংলাদেশ সরকারের সম্পত্তি। কার্ডটি অন্য কোথাও পাওয়া গেলে নিকটস্থ উপজেলা মৎস্য অফিসে জমা দেওয়ার জন্য অনুরোধ করা হচ্ছে।</p>
                    <p class="lead">This card is the property of the Government of Bangladesh If found, Please return to Department of Fisheries, Dhaka, Bangladesh </p>
                </div>

                <div class="card-body">
                    <div class="card-left">
                        <div class="nid-no fw-bold mb-2">NID NO: {{ $data->nationalIdNo ?? '' }}</div>
                        <div class="qr-code">
                            {!! QrCode::size(80)->generate('Fishers Id: '.$data->fId. "\n" .'Name: '.$data->fishermanNameEng. "\n" .'National Id No: '.$data->nationalIdNo. "\n" .'Date of Birth: '.date('d-M-Y', strtotime($data->dateOfBirth))) !!}
                        </div>
                    </div>
                    <div class="card-right">
                        <div class="mb-2">
                            <h4 class="text-center">ঠিকানাঃ</h4>
                            <p class="lead">মহল্লা/গ্রামঃ {{ $getPermanentVillageData->villageBng ?? 'N/A' }}, ডাকঘরঃ {{ $getPermanentPostOfficeData->postOfficeBangla ?? 'N/A' }}, ইউনিয়নঃ {{ $getPermanentUnionData->unionBng ?? 'N/A' }}, উপজেলাঃ {{ $getPermanentUpazilaData->upazilaBng ?? '' }}, জেলাঃ {{ $data->fishermen_district->districtBng ?? '' }}</p>
                        </div>
                        <div>
                            <h4 class="text-center">Address</h4>
                            <p class="lead">Mohalla/Village: {{ $getPermanentVillageData->villageEng ?? 'N/A' }}, Post Office: {{ $getPermanentPostOfficeData->postOfficeEnglish ?? 'N/A' }}, Union: {{ $getPermanentUnionData->unionEng ?? 'N/A' }}, Upazila: {{ $getPermanentUpazilaData->upazilaEng ?? '' }}, District: {{ $data->fishermen_district->districtEng ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>