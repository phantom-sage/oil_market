<template>
    <div class="formApp">
        <input type="text" name="steet" v-model="street">
        <button @click="addStreet">add</button>
        <div v-for="str in streetArray">
            <div @click="removeStreet($event)">{{ str }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'formApp',
    data() {
        return {
            streetArray: [],
            street: '',
        }
    },
    methods: {
        addStreet() {
            this.streetArray.push(this.street);
            this.street = '';
        },
        removeStreet(event) {
            var index = this.streetArray.indexOf(event.target.innerText);
            index > -1 ? this.streetArray.splice(index, 1):'';
        }
    }
}
</script>

<style scoped>

</style>
