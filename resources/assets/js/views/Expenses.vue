<template>
    <div class="columns">

        <addExpense v-if="showAddExpenseModal" @completed="addedExpense" @close="showAddExpenseModal = false"></addExpense>
        <deleteExpense v-if="showDeleteExpenseModal" @completed="deletedExpense" @close="showDeleteExpenseModal = false" :expense="expense"></deleteExpense>
        <viewExpense v-if="showViewExpenseModal" @completed="viewedExpense" @close="showViewExpenseModal = false" :expense="expense"></viewExpense>

        <div class="message is-danger">
            <div class="message-header">
                Expense detail
                <a class="button is-danger is-inverted is-outlined" @click="showAddExpenseModal = true" style="text-decoration: none">Add Expense</a>
            </div>

            <div class="message-body">
                <form>
                    <div class="field is-horizontal is-clearfix">

                        <div class="field-body">
                            <div class="field is-grouped">
                                <p class="control">
                                    <datepicker
                                            id="datepicker"
                                            placeholder="Search From"
                                            :config="{ dateFormat: 'Y-m-d', altInput: true, altFormat: 'd-m-Y', static: true }"
                                            v-model="form.fromDate">
                                    </datepicker>
                                </p>
                                <p class="control ">
                                    <datepicker
                                            placeholder="Search To"
                                            :config="{ dateFormat: 'Y-m-d', altInput: true, altFormat: 'd-m-Y', static: true }"
                                            v-model="form.toDate">
                                    </datepicker>
                                </p>
                                <p class="control">
                                    <a class="button is-danger is-outlined" @click="onSearch()"
                                       style="text-decoration: none">Search Expense</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <br/>
                </form>

                <div class="box">


                    <table class="table">
                        <thead>
                        <tr>
                            <th class="is-narrow">Date</th>
                            <th class="is-narrow">Description</th>
                            <th class="is-narrow">Category</th>
                            <th class="is-narrow">Sub Category</th>
                            <th class="is-narrow">Account Name</th>
                            <th class="is-narrow">Amount</th>
                            <th class="is-narrow"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="expense in expenses">
                            <td class="is-narrow">{{ expense.created_at | date }}</td>
                            <td class="is-narrow">{{ expense.expenseDescription }}</td>
                            <td class="is-narrow">{{ expense.category.categoryName }}</td>
                            <td class="is-narrow">{{ expense.subcategory.subcategoryName }}</td>
                            <td class="is-narrow">{{ expense.account.accountName }}</td>
                            <td class="is-narrow">{{ expense.amount | currency }}</td>

                            <td>
                                <a style="text-decoration: none" @click="viewExpense(expense)">
                                    <span class="icon is-small">
                                      <i class="fa fa-wrench"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="deleteExpense(expense)">
                                    <span class="icon is-small">
                                      <i class="fa fa-trash"></i>
                                    </span>
                                </a>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</template>

<script>

    import Expense from '../models/Expense';
    import addExpense from '../forms/AddExpense.vue';
    import deleteExpense from '../forms/DeleteExpense.vue'
    import viewExpense from '../forms/ViewExpense.vue'
    import Datepicker from 'vue-bulma-datepicker'

    export default {

        components: {
            addExpense,
            deleteExpense,
            viewExpense,
            Datepicker
        },

        data() {
            return {
                expenses: [],
                expense: [],
                prevFromDate: '',
                prevToDate: '',
                showAddExpenseModal: false,
                showDeleteExpenseModal: false,
                showViewExpenseModal: false,
                form: new Form({fromDate: '', toDate: ''})
            }
        },

        filters: {
            date(date){
                return moment(date, 'YYYY-MM-DD').format('DD-MM-YYYY');
            },
            date30(date){
                return moment(date, 'YYYY-MM-DD').subtract(30, 'days').format('DD-MM-YYYY');
            },
            currency(amount) {

                let val = (amount/1).toFixed(2).replace('.', ',');
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");

            }
        },

        created() {
            Expense.all()
                .then(({data}) => this.expenses = data);
        },

        methods: {

            onSearch() {

                if (this.form.fromDate == "") {
                    this.$set(this.form, 'fromDate', this.prevFromDate);
                };

                if (this.form.toDate == "") {
                    this.$set(this.form, 'toDate', this.prevToDate);
                };

                this.form
                    .post('/expenses')
                    .then(response => this.expenses = response);

                this.$set(this, 'prevFromDate', this.form.fromDate);
                this.$set(this, 'prevToDate', this.form.toDate);

            },

            addedExpense(expense) {
                expense = expense.shift();
                this.expenses.unshift(expense);
                this.showAddExpenseModal = false
            },

            deleteExpense(expense) {
                this.$set(this.expense, 0, expense);
                this.showDeleteExpenseModal = true;
            },

            deletedExpense(expenseId) {
                this.expenses = this.expenses.filter(function (expense) {
                    return expense.id != expenseId;
                });
                this.showDeleteExpenseModal = false;
            },

            viewExpense(expense) {
                this.$set(this, 'expense', expense);
                this.showViewExpenseModal = true;
            },

            viewedExpense(expenseUpdated) {
                let expenseIndex = this.expenses
                    .findIndex(expense => expense.id === expenseUpdated[0].id);
                this.$set(this.expenses, expenseIndex, expenseUpdated[0]);
                this.showViewExpenseModal = false;
            }
        }

    }
</script>
