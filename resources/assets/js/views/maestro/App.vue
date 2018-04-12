<template>

    <div class="content">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                         <router-link :to="{ name: 'index' } " class="nav-link text-white">Inicio</router-link>
                     </li>
                     <li class="nav-item dropdown">
                       <a href="#" class="nav-link dropdown-toggle" id="menu-categorias" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Reactivos
                    </a>
                    <div class="dropdown-menu text-center" aria-labelledby="menu-categorias">
                        <li>
                            <router-link :to="{ name: 'reactivo.list' } " class="nav-link text-dark">Ver reactivos</router-link>
                        </li>

                        <li>
                            <router-link :to="{ name: 'reactivo.create' } " class="nav-link text-dark">Crear reactivos</router-link>
                        </li>
                    </div>
                </li>

                <li class="nav-item">
                    <router-link :to="{ name: 'cuestionarios' } " class="nav-link text-white">Cuestionarios</router-link>
             </li>
         </ul>
     </div>
 </nav>
</header>
<div class="container">
    <router-view></router-view>
</div>
</div>
</template>



<script>
export default {}
</script>