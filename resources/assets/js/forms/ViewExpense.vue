<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Update Expense</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">

                <form>

                    <div class="field">
                        <label class="label">Update Expense Description from: {{ expense[0].expenseDescription
                            }} </label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.expenseDescription">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Update Expense Category from: {{ expense[0].category.categoryName
                            }}</label>
                        <p class="control">
                            <span class="select">
                              <select v-model="form.category_id" @change="categorySelected($event)">
                                <option v-for="category in categories[0]" :value="category.id">{{ category.categoryName
                                    }}</option>
                              </select>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Update Expense Subcategory from: {{ expense[0].subcategory.subcategoryName
                            }}</label>
                        <p class="control">
                            <span class="select">
                              <select v-model="form.subcategory_id">
                                <option v-for="subcategory in subcategories"
                                        :value="subcategory.id">{{ subcategory.subcategoryName }}</option>
                              </select>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Update Expense Account from: {{ expense[0].account.accountName }}</label>
                        <p class="control">
                            <span class="select">
                              <select v-model="form.account_id">
                                <option v-for="account in accounts" :value="account.id">{{ account.accountName
                                    }}</option>
                              </select>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Update the Expense Amount from: {{ expense[0].amount }}</label>
                        <p class="control">
                            <input class="input" type="number" v-model="form.amount">
                        </p>
                    </div>
                </form>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-danger" @click="onSubmit(expense[0].id)">Update Expense</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>

    import Account from '../models/Account'
    import Category from '../models/Category'
    import Subcategory from '../models/Subcategory'

    export default {

        props: ['expense'],

        data() {
            return {
                form: new Form({
                    expenseDescription: '',
                    category_id: '',
                    subcategory_id: '',
                    account_id: '',
                    amount: ''
                }),
                accounts: [],
                categories: [],
                subcategories: [],
            }

        },

        created() {
            Account.all()
                .then(({data}) => this.accounts = data);
            Category.all()
                .then(({data}) => this.categories = data);
        },

        methods: {

            categorySelected(event) {
                Subcategory.all(event.target.value)
                    .then(({data}) => this.subcategories = data);
            },

            onSubmit(expenseId) {
                this.form
                    .put('/expenses/' + expenseId)
                    .then(expense => this.$emit('completed', expense));
            }

        }

    }


</script>