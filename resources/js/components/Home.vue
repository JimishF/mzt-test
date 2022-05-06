<template>
  <!-- Container for demo purpose -->
  <div class="container my-24 px-6 mx-auto">

    <!-- Section: Design Block -->
    <section class="mb-32 text-gray-800 text-center lg:text-left">

      <div class="grid lg:grid-cols-2 gap-6 xl:gap-12 items-center">
        <div class="mb-6 lg:mb-0">
          <h2 class="text-5xl md:text-6xl xl:text-7xl font-bold tracking-tight">
            Join, Find And Hire<br/>
            <span class="text-blue-600">Connecting People And Businesses </span>
          </h2>
        </div>
        <div class="mb-6 lg:mb-0">
          <router-link to="/candidates" tag="a" class="uppercase rounded border-2 p-2 border-blue-600 text-blue-600 font-bold" >
            Candidate list
          </router-link>

          <p class="text-gray-500 text-lg mt-5">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima officia consequatur
            adipisci tenetur repudiandae rerum quos.
          </p>
        </div>
      </div>

    </section>
  </div>
</template>
<script>
  export default {}
</script>