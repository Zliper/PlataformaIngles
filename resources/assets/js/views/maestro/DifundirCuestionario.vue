<template>
    <div>
        {{ welcome }}
    </div>
</template>

<script>
export default {
    props: ['id'],
    data() {
        return {
            welcome: 'No hay datos'
        }
    },
    mounted() {
        
        console.log(this.id);
        if (this.id) {
            this.welcome = 'Nombre:     ' + this.id.nota + ', ID: ' + this.id.id
        }

    }
}
</script>
    
<style>

</style>


