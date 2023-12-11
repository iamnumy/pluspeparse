<template>
    <div class="overflow-x-auto">
        <table class="w-full bg-white border border-gray-200 shadow-lg">
            <thead>
            <tr>
<!--                <th class="px-6 py-3 bg-gray-100 border-b">Payment Utr</th>-->
                <th class="py-3 bg-gray-100 border-b">Account Number</th>
                <th class="px-6 py-3 bg-gray-100 border-b">Bank Name</th>
                <th class="px-6 py-3 bg-gray-100 border-b">Deposit</th>
                <th class="px-6 py-3 bg-gray-100 border-b">Desc</th>
                <th class="px-6 py-3 bg-gray-100 border-b">Date</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in paginatedData" :key="item.payment_utr" class="hover:bg-gray-100">
<!--                <td class="px-6 py-4 border-b">{{ item.payment_utr }}</td>-->
                <td class="px-6 py-4 border-b">{{ item.account_number }}</td>
                <td class="px-6 py-4 border-b">{{ item.bank_name }}</td>
                <td class="px-6 py-4 border-b">{{ item.amount }}</td>
                <td class="px-6 py-4 border-b">{{ item.account_number_desc }}</td>
                <td class="px-4 py-4 border-b">{{ item.transaction_date }}</td>
            </tr>
            </tbody>
        </table>

        <div class="flex justify-center mt-4">
            <button class="px-4 py-2 mx-2 bg-gray-200" :disabled="currentPage === 1" @click="goToPage(currentPage - 1)">
                Previous
            </button>

            <template v-for="page in displayedPages">
                <button
                    class="px-4 py-2 mx-2 bg-gray-200"
                    :class="{ 'bg-gray-400': currentPage === page }"
                    @click="goToPage(page)"
                >
                    {{ page }}
                </button>
            </template>

            <button class="px-4 py-2 mx-2 bg-gray-200" :disabled="currentPage === totalPages" @click="goToPage(currentPage + 1)">
                Next
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        data: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            currentPage: 1,
            itemsPerPage: 10,
        };
    },
    computed: {
        paginatedData() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.data.slice(startIndex, endIndex);
        },
        totalPages() {
            return Math.ceil(this.data.length / this.itemsPerPage);
        },
        displayedPages() {
            const displayedPageCount = 5;
            const pageOffset = Math.floor(displayedPageCount / 2);
            const startPage = Math.max(1, this.currentPage - pageOffset);
            const endPage = Math.min(this.totalPages, startPage + displayedPageCount - 1);
            const displayedPages = [];

            for (let page = startPage; page <= endPage; page++) {
                displayedPages.push(page);
            }

            return displayedPages;
        },
    },
    methods: {
        goToPage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
            }
        },
    },
};
</script>
