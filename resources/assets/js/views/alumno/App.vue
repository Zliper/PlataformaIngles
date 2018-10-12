<template>

    <div class="content">
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="container">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <router-link :to="{ name: 'index' } " class="nav-link text-white">Inicio</router-link>
                            </li>
                        </ul>
                    </div>
               </div>
           </nav>
       </header>

       <div class="container">
            <router-view></router-view>
       </div>
</div>

</template>

<script>
export default {};
</script>