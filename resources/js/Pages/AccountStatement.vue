<template>
    <div>
        <Table/>
        {{data}}
    </div>
</template>

<script>
import Table from '../Components/views/Table.vue';

export default {
    components: {
        Table,
    },
    props: {
        data: {
            type: Object,
            required: true,
        },
    },
    mounted() {
        console.log("data",this.data);
    },
};
</script>
