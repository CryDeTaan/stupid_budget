<template>
    <div class="columns">

        <addExpense v-if="showAddExpenseModal" @completed="addedExpense" @close="showAddExpenseModal = false"></addExpense>
        <deleteExpense v-if="showDeleteExpenseModal" @completed="deletedExpense" @close="showDeleteExpenseModal = false" :expense="expense"></deleteExpense>
        <viewExpense v-if="showViewExpenseModal" @completed="viewedExpense" @close="showViewExpenseModal = false"
                     :expense="expense"></viewExpense>


        <div class="message is-danger">
            <div class="message-header">
                Expense details
                <a class="button is-danger is-inverted is-outlined" @click="showAddExpenseModal = true" style="text-decoration: none">Add Expense</a>
            </div>

            <div class="message-body">

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
                            <td class="is-narrow">{{ expense.amount }}</td>

                            <td>
                                <a style="text-decoration: none" @click="viewExpense(expense)">
                                    <span class="icon is-small">
                                      <i class="fa fa-info-circle"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="deleteExpense(expense)">
                                    <span class="icon is-small">
                                      <i class="fa fa-times-circle"></i>
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

    export default {

        components: {
            addExpense,
            deleteExpense,
            viewExpense
        },

        data() {
            return {
                expenses: [],
                expense: [],
                showAddExpenseModal: false,
                showDeleteExpenseModal: false,
                showViewExpenseModal: false,
            }
        },

        filters: {
            date(created_at){
                return moment(created_at, 'YYYY-MM-DD').format('DD-MM-YYYY');
            }
        },

        created() {
            Expense.all()
                .then(({data}) => this.expenses = data);
        },

        methods: {
            addedExpense(expense) {
                expense = expense.shift();
                this.expenses.unshift(expense);
                this.showAddExpenseModal = false
            },

            deleteExpense(expense) {
                this.$set(this.expense,0,expense);
                this.showDeleteExpenseModal = true;
            },

            deletedExpense(expenseId) {
                this.expenses = this.expenses.filter(function (expense) {
                    return expense.id != expenseId;
                });
                this.showDeleteExpenseModal = false;
            },

            viewExpense(expense) {
                this.$set(this.expense, 0, expense);
                this.showViewExpenseModal = true;
            },

            viewedExpense() {
                this.showViewExpenseModal = false;
            }
        }

    }
</script>
