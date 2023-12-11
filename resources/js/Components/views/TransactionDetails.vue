<template>
    <div>
        <NavBar />
        <div className="shadow-lg m-3 p-4">
            <div className="m-3 flex items-center">
                <div className="ml-4">
                    <Modal :selectedBank="selectedBank" />
                </div>
            </div>
        </div>
        <div className="shadow-lg w-full p-4 mb-4">
            <TransactionTable :data="data"/>
        </div>
    </div>
</template>

<script>
import Table from './Table.vue';
import Modal from "./Modal.vue";
import NavBar from "@/Components/views/NavBar.vue";
import TransactionTable from "@/Components/views/TransactionTable.vue";

export default {
    name: "AccountStatement",
    components: {
        TransactionTable,
        NavBar,
        Modal,
        Table,
    },
    data() {
        return {
            data: [],
            fileExtension: 'xlsx',
            selectedBank: 'all',
        };
    },
    mounted() {
        this.getFileData();
    },
    methods: {
        getFileData() {
            axios.get('/transaction-details')
                .then(response => {
                    console.log(response);
                    this.data = response.data.data;

                })
                .catch(error => {
                    console.error(error);
                });
        },
        fetchUjjivanExcel() {

        },
        fetchSbiExcel() {
            axios.get('/fetch-sbi-excel')
                .then(response => {
                    this.data = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        fetchUjjivanCsv() {
            axios.get('/ujjivan-csv')
                .then(response => {
                    this.data = response.data.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        fetchHdfcExcel() {
            axios.get('/fetch-hdfc-excel')
                .then(response => {
                    this.data = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        fetchAll() {
            axios.get('/fetch-all')
                .then(response => {
                    this.data = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
};
</script>
