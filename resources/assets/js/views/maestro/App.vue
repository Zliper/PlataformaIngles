<template>

    <div class="content">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                             <router-link :to="{ name: 'home' } " class="nav-link text-white">Home</router-link>
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