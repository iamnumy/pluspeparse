<template>
    <div>
        <button
            @click="isOpen = true"
            class="mt-3 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
        >
            Upload File
        </button>

        <div
            v-if="isOpen"
            class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75"
        >
            <div class="bg-white rounded-lg w-1/2 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Upload</h2>
                    <button
                        @click="isOpen = false"
                        class="text-gray-500 hover:text-gray-700"
                    >
                        <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M18 6L6 18M6 6l12 12"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>
                </div>

                <div class="mt-4 p-2 mb-2">
                    <label for="excel-upload" class="block text-sm font-medium text-gray-700"
                    >Upload Excel Here</label
                    >
                    <input
                        id="excel-upload"
                        type="file"
                        class="mt-1 border-dotted border-2 border-gray-400 p-6"
                        @change="handleFileUpload"
                    />
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        @click="isOpen = false"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded mr-2"
                    >
                        Cancel
                    </button>
                    <button
                        @click="saveFile"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        selectedBank: {
            type: String,
        }
    },
    data() {
        return {
            isOpen: false,
            selectedFile: null,
            selectedValue: null,
        };
    },
    methods: {
        handleFileUpload(event) {
            this.selectedFile = event.target.files[0];
        },
        saveFile() {
            if (this.selectedFile) {
                const fileExtension = this.selectedFile.name.split('.').pop();
                if (fileExtension === 'xlsx' || fileExtension === 'xls') {
                    const formData = new FormData();
                    formData.append('selectedBank', this.selectedBank);
                    formData.append('excelFile', this.selectedFile);
                    this.saveExcel(formData);
                } else if (fileExtension === 'csv') {
                    const formData = new FormData();
                    formData.append('csvFile', this.selectedFile);
                    formData.append('selectedBank', this.selectedBank);
                    this.saveCsv(formData, this.selectedValue);
                } else {
                    console.error('Unsupported file format');
                    return;
                }
            }

            this.isOpen = false;
        },
        saveExcel(formData) {
            axios
                .post('/upload-excel', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                })
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        saveCsv(formData) {
            axios
                .post('/upload-csv', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                })
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
};
</script>
