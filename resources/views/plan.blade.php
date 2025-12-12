@extends('shared.main')

@section('content')
    <div class="section w-full items-center mt-[150px] max-w-[1920px] flex flex-col gap-2 p-[50px] max-[720px]:p-5">
        <h1 class="text-4xl font-bold text-center w-full">
            Grow Your Business on <span class="text-(--accent)"> 10Firms! </span>
        </h1>

        <p class="text-center w-full max-w-[700px]">More than $2 billion in global service projects flow through Clutch every
            <pre class="max-w-[600px]"> {{ print_r($companies)  }}</pre>
            year. Get listed today to gain
            visibility with 12+ million buyers searching for their next business partner.</p>
        <div class="flex gap-2 justify-between w-full max-w-[700px]">
            <img class="w-20 rounded-full" src={{ 'https://picsum.photos/360/360?random=' . mt_rand(1, 9999) }}
                alt="">
            <img class="w-20 rounded-full" src={{ 'https://picsum.photos/360/360?random=' . mt_rand(1, 9999) }}
                alt="">
            <img class="w-20 rounded-full" src={{ 'https://picsum.photos/360/360?random=' . mt_rand(1, 9999) }}
                alt="">
            <img class="w-20 rounded-full" src={{ 'https://picsum.photos/360/360?random=' . mt_rand(1, 9999) }}
                alt="">
            <img class="w-20 rounded-full" src={{ 'https://picsum.photos/360/360?random=' . mt_rand(1, 9999) }}
                alt="">
        </div>
    </div>
    <div class="plans flex-wrap w-full max-w-[1920px] flex gap-4 items-start justify-around p-[50px] max-[720px]:p-5">
        <div class="plan outline-2 outline-(--accent) rounded-md p-5 gap-2 flex flex-col">
            <h2 class="text-3xl font-bold">Basic</h2>
            <strong>Set up Company Profile</strong>
            <h2 class="text-2xl font-bold">Free</h2>
            <button class="btn-secondary-shade">Create a Free Profile</button>
            <strong>Basic Includes</strong>
            <ul>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>No Link to Your Website from Directory Pages</li>
            </ul>
        </div>
        <div class="plan bg-(--accent) text-(--primary) rounded-md p-5 gap-2 flex flex-col">
            <span class="flex justify-between">
                <h2 class="text-3xl font-bold">Verfied</h2>
                <button class="p-2 text-(--black) bg-(--primary) text-xs rounded-md">Popular</button>
            </span>
            <strong>Build Credibility & Buyer Trust</strong>
            <h2 class="text-2xl font-bold">$499/year</h2>
            <button class="btn-secondary-shade">Get Clutch Verified</button>
            <strong>Basic Includes</strong>
            <ul>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>No Link to Your Website from Directory Pages</li>
            </ul>
        </div>
        <div class="plan outline-2 outline-(--accent) rounded-md p-5 gap-2 flex flex-col">
            <h2 class="text-3xl font-bold">Advertiser</h2>
            <strong>Boost Visibility on Directories</strong>
            <h2 class="text-2xl font-bold">Custom Pricing</h2>
            <button class="btn-secondary-shade">Learn About Advertising</button>
            <strong>Everything in Verified, and:</strong>
            <ul>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>Basic Company Information</li>
                <li>No Link to Your Website from Directory Pages</li>
            </ul>
        </div>
    </div>
    <div class="section w-full items-center max-w-[1920px] flex flex-col gap-2 p-[50px] max-[720px]:p-5">
        <h1 class="text-3xl font-semibold text-center w-full">
            What others say about growing their <span class="text-(--accent)"> business </span>on 10Firms
        </h1>
        <div class="wrapper w-full gap-4 max-[800px]:flex-col flex-wrap flex justify-between">
            <div class="flex flex-col gap-2 max-[800px]:w-full w-[250px]">
                <div class="flex gap-2">
                    <img class="w-15 rounded-md" src={{ 'https://picsum.photos/360/360?random=' . mt_rand(1, 9999) }}
                        alt="">
                    <span class="flex flex-col justify-around">
                        <strong>Agency</strong>
                        <small>Creative Works</small>
                    </span>
                </div>
                <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique debitis dolores eum quibusdam
                    repudiandae mollitia ab beatae error quia eligendi sunt</small>
            </div>
            <div class="flex flex-col gap-2 max-[800px]:w-full w-[250px]">
                <div class="flex gap-2">
                    <img class="w-15 rounded-md" src={{ 'https://picsum.photos/360/360?random=' . mt_rand(1, 9999) }}
                        alt="">
                    <span class="flex flex-col justify-around">
                        <strong>Agency</strong>
                        <small>Creative Works</small>
                    </span>
                </div>
                <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique debitis dolores eum quibusdam
                    repudiandae mollitia ab beatae error quia eligendi sunt</small>
            </div>
            <div class="flex flex-col gap-2 max-[800px]:w-full w-[250px]">
                <div class="flex gap-2">
                    <img class="w-15 rounded-md" src={{ 'https://picsum.photos/360/360?random=' . mt_rand(1, 9999) }}
                        alt="">
                    <span class="flex flex-col justify-around">
                        <strong>Agency</strong>
                        <small>Creative Works</small>
                    </span>
                </div>
                <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique debitis dolores eum quibusdam
                    repudiandae mollitia ab beatae error quia eligendi sunt</small>
            </div>
            <div class="flex flex-col gap-2 max-[800px]:w-full w-[250px]">
                <div class="flex gap-2">
                    <img class="w-15 rounded-md" src={{ 'https://picsum.photos/360/360?random=' . mt_rand(1, 9999) }}
                        alt="">
                    <span class="flex flex-col justify-around">
                        <strong>Agency</strong>
                        <small>Creative Works</small>
                    </span>
                </div>
                <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique debitis dolores eum quibusdam
                    repudiandae mollitia ab beatae error quia eligendi sunt</small>
            </div>
        </div>
    </div>
@endsection
