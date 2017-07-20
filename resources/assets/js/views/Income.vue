<template>
    <div class="columns">

        <addIncome v-if="showAddIncomeModal" @completed="addedIncome" @close="showAddIncomeModal = false"></addIncome>
        <deleteIncome v-if="showDeleteIncomeModal" @completed="deletedIncome" @close="showDeleteIncomeModal = false" :income="income"></deleteIncome>
        <viewIncome v-if="showViewIncomeModal" @completed="viewedIncome" @close="showViewIncomeModal = false" :income="income"></viewIncome>

        <div class="message is-success">
            <div class="message-header">
                Income details
                <a class="button is-success is-inverted is-outlined" @click="showAddIncomeModal = true" style="text-decoration: none">Add Income</a>
            </div>
            <div class="message-body">

                <form>
                    <div class="field is-horizontal is-clearfix">
                        <!--<div class="field-label is-normal">
                            <label class="label">Filter</label>
                        </div>-->
                        <div class="field-body">
                            <div class="field is-grouped">
                                <p class="control">
                                    <datepicker
                                            placeholder="Search From"
                                            :config="{ dateFormat: 'Y-m-d', altInput: true, altFormat: 'd-m-Y', static: true}"
                                            v-model="form.fromDate">

                                    </datepicker>
                                </p>
                                <p class="control ">
                                    <datepicker
                                            placeholder="Search To"
                                            :config="{ dateFormat: 'Y-m-d', altInput: true, altFormat: 'd-m-Y', static: true}"
                                            v-model="form.toDate">
                                    </datepicker>
                                </p>
                                <p class="control">
                                    <a class="button is-success is-outlined" @click="onSearch()"
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
                            <th class="is-narrow">Income</th>
                            <th class="is-narrow">Account</th>
                            <th class="is-narrow">Amount</th>
                            <th class="is-narrow"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="income in incomes">
                            <td class="is-narrow">{{ income.created_at | date }}</td>
                            <td class="is-narrow">{{ income.incomeDescription }}</td>
                            <td class="is-narrow">{{ income.account.accountName }}</td>
                            <td class="is-narrow">{{ income.amount | currency }}</td>

                            <td>
                                <a style="text-decoration: none" @click="viewIncome(income)">
                                    <span class="icon is-small">
                                      <i class="fa fa-wrench"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="deleteIncome(income)">
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

    import Income from '../models/Income'
    import addIncome from '../forms/AddIncome.vue';
    import deleteIncome from '../forms/DeleteIncome.vue'
    import viewIncome from '../forms/ViewIncome.vue'
    import Datepicker from 'vue-bulma-datepicker'

    export default {

        components: {
            addIncome,
            deleteIncome,
            viewIncome,
            Datepicker
        },

        data() {
            return {
                incomes: [],
                income: [],
                prevFromDate: '',
                prevToDate: '',
                showAddIncomeModal: false,
                showDeleteIncomeModal: false,
                showViewIncomeModal: false,
                form: new Form({fromDate: '', toDate: ''})
            }

        },

        filters: {
            date(created_at){
                return moment(created_at, 'YYYY-MM-DD').format('DD-MM-YYYY');
            },

            date30(date){
                return moment(date, 'YYYY-MM-DD').subtract(30, 'days').format('DD-MM-YYYY');
            },
            currency(amount) {
                let val = (amount/1).toFixed(2).replace('.', ',');
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
//                return 'R ' + amount.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            },
        },

        created() {
            Income.all()
                .then(({data}) => this.incomes = data);
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
                    .post('/income')
                    .then(response => this.incomes = response);

                this.$set(this, 'prevFromDate', this.form.fromDate);
                this.$set(this, 'prevToDate', this.form.toDate);

            },

            addedIncome(income) {
                income = income.shift();
                this.incomes.unshift(income);
                this.showAddIncomeModal = false
            },

            deleteIncome(income) {
                this.$set(this.income,0,income);
                this.showDeleteIncomeModal = true;
            },

            deletedIncome(incomeId) {
                this.incomes = this.incomes.filter(function (income) {
                    return income.id != incomeId;
                });
                this.showDeleteIncomeModal = false;
            },

            viewIncome(income) {
                this.$set(this,'income',income);
                this.showViewIncomeModal = true;
            },

            viewedIncome(incomeUpdated) {
                let incomeIndex = this.incomes
                    .findIndex(income => income.id === incomeUpdated[0].id);
                this.$set(this.incomes,incomeIndex, incomeUpdated[0]);
                this.showViewIncomeModal = false;
            }
        }

    }
</script>
