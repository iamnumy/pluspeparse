<template>
    <div>
        <NavBar />
        <div className="shadow-lg m-3 p-4">
            <div className="m-3 flex items-center">
                <label htmlFor="bankSelection" className="mr-2">Bank:</label>
                <select id="bankSelection" v-model="selectedBank" className="mr-2">
                    <option value="all">All</option>
                    <option value="pluspe">Pluspe BANK</option>
                </select>

                <label className="mr-4">
                    <input type="radio" value="csv" v-model="fileExtension" className="mr-1">
                    CSV
                </label>
                <label>
                    <input type="radio" value="xlsx" v-model="fileExtension" className="mr-1">
                    XLSX
                </label>
                <div className="ml-4">
                    <Modal :selectedBank="selectedBank" />
                </div>
            </div>
        </div>
        <div className="shadow-lg w-full p-4 mb-4">
            <Table :data="data"/>
        </div>
    </div>
</template>

<script>
import Table from './Table.vue';
import Modal from "./Modal.vue";
import NavBar from "@/Components/views/NavBar.vue";

export default {
    name: "AccountStatement",
    components: {
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
    watch: {
        fileExtension() {
            this.getFileData();
        },
        selectedBank() {
            this.getFileData();
        },
    },
    methods: {
        getFileData() {
            if (this.fileExtension === 'csv') {
                if (this.selectedBank === 'pluspe') {
                    this.fetchPluspeCsv();
                }
                else {
                    console.error('Unsupported bank selection');
                }
            } else if (this.fileExtension === 'xlsx') {
                if (this.selectedBank === 'pluspe') {
                    this.fetchPluspeExcel();
                }
                else {
                    console.error('Unsupported bank selection');
                }
            } else {
                console.error('Unsupported file extension');
            }
        },
        fetchPluspeExcel() {
            axios.get('/pluspe-csv')
                .then(response => {
                    this.data = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        fetchPluspeCsv() {
            axios.get('/pluspe-csv')
                .then(response => {
                    this.data = response.data.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
};
</script>
