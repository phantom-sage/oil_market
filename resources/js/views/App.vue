<template>
    <div>
        <bill-sell></bill-sell>
    </div>
</template>

<script>
import BillSell from '../components/Bill-Sell';
export default {
    name: "App",
    components: {
        "bill-sell": BillSell
    },
    mounted() {
    }
}
</script>

<style scoped>

</style>
