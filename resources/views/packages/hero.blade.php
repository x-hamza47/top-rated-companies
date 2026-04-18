   <div class="section md:pt-32  pt-25 pb-20 flex items-center flex-wrap gap-y-6 lg:flex-row flex-col text-white">
       <div class="flex flex-col items-center lg:items-start gap-4 lg:text-start text-center flex-1 ">
           <h1 class="text-4xl sm:text-4xl md:text-5xl font-bold w-full max-w-[700px]">
               Explore predefined packages of<span class="text-lime-600"> {{ $service->name }} </span>services</span>
           </h1>
           {{-- @dd($packages) --}}

           <p class="md:leading-6 leading-5 font-semibold text-gray-300 md:text-base text-sm max-w-[900px]">
               Are you looking to build or customize software to address your company’s specific needs? These software
               development packages below will help you get to your custom solution to boost your team’s productivity
           </p>

       </div>
       {{-- ! Hero Image --}}
       <div class="flex-2/5 min-w-[200px] max-w-[500px] ">
           <img src="https://clutch.co/static/images/package-cards.webp"
               alt="Software development, marketing, and consulting illustration"
               class="w-full h-full drop-shadow-[0_50px_20px_rgba(0,0,0,1)] hover:drop-shadow-transparent hover:scale-[0.99]">
       </div>
   </div>
