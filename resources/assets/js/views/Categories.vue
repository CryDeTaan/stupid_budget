<template>
    <div class="columns">

        <addCategory v-if="showAddCategoryModal" @completed="addedCategory" @close="showAddCategoryModal = false"></addCategory>
        <addSubCategory v-if="showAddSubCategoryModal" @completed="addedSubcategory" @close="showAddSubCategoryModal = false" :category="category"></addSubCategory>

        <addSubcategoryExpense v-if="showAddSubcategoryExpenseModal" @completed="addedSubcategoryExpense" @close="showAddSubcategoryExpenseModal = false" :subcategory="subcategory"></addSubcategoryExpense>

        <deleteCategory v-if="showDeleteCategoryModal" @completed="deletedCategory" @close="showDeleteCategoryModal = false" :category="category"></deleteCategory>
        <viewCategory v-if="showViewCategoryModal" @completed="viewedCategory" @close="showViewCategoryModal = false" :category="category"></viewCategory>

        <deleteSubcategory v-if="showDeleteSubcategoryModal" @completed="deletedSubcategory" @close="showDeleteSubcategoryModal = false" :subcategory="subcategory"></deleteSubcategory>
        <viewSubcategory v-if="showViewSubcategoryModal" @completed="viewedSubcategory" @close="showViewSubcategoryModal = false" :subcategory="subcategory"></viewSubcategory>

        <viewBudgetStartDay v-if="showViewBudgetStartDayModal" @completed="viewedBudgetStartDay" @close="showViewBudgetStartDayModal = false" :budgetStartDay="budgetStartDay"></viewBudgetStartDay>

        <div class="column">
            <div class="message is-primary">
                <div class="message-header">
                    <div>
                    Category Details <br/>
                        Monthly budget start on day: {{ budgetStartDay }}
                        <a style="text-decoration: none" @click="viewBudgetStartDay(budgetStartDay)">
                            <span class="icon is-small">
                                <i class="fa fa-wrench"></i>
                            </span>
                        </a>
                </div>
                    <a class="button is-primary is-inverted is-outlined" @click="showAddCategoryModal = true" style="text-decoration: none">Add Category</a>
                </div>
                <div class="message-body">
                    <div v-for="category in categories" :id="category.id">
                        <div class="columns">
                            <div class="column is-1">
                                <h2><strong>{{ category.categoryName }}</strong></h2>
                            </div>
                            <div class="column" style="padding-top: 16px">
                                <progress class="progress" :class=category.budgetProgress :value=category.categoryBudgetUsed :max=category.categoryBudget :title=category.categoryBudgetUsed></progress>
                            </div>
                            <div class="column is-2 is-small">
                                    <strong class="has-text-centered" style="font-size: 75%">
                                        {{ category.categoryBudgetUsed | currency
                                        }} / {{ category.categoryBudget | currency }}
                                    </strong>
                            </div>
                            <div class="column is-1">
                                <a style="text-decoration: none" @click="addSubCategory(category)">
                                    <span class="icon is-small">
                                      <i class="fa fa-plus"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="viewCategory(category)">
                                    <span class="icon is-small">
                                      <i class="fa fa-wrench"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="deleteCategory(category)">
                                    <span class="icon is-small">
                                      <i class="fa fa-trash"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="columns selectorClass"
                             v-for="subcategory in category.subcategory">
                            <div class="column is-2">
                                <div class="level-right">{{ subcategory.subcategoryName }}</div>
                            </div>
                            <div class="column" style="padding-top: 17px">
                                <progress class="progress" :class=subcategory.budgetProgress :value=subcategory.budgetUsed :max=subcategory.subcategoryBudget></progress>
                            </div>
                            <div class="column is-2">
                                <p style="font-size: 75%">
                                    {{ subcategory.budgetUsed | currency
                                    }} / {{ subcategory.subcategoryBudget | currency }}
                                </p>
                            </div>
                            <div class="column is-1">
                                <a style="text-decoration: none" @click="addSubcategoryExpense(subcategory)">
                                    <span class="icon is-small">
                                      <i class="fa fa-plus"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="viewSubcategory(subcategory)">
                                    <span class="icon is-small">
                                      <i class="fa fa-wrench"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="deleteSubcategory(subcategory)">
                                    <span class="icon is-small">
                                      <i class="fa fa-trash"></i>
                                    </span>
                                </a>
                                <span class="icon is-small">
                                </span>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    import Category from '../models/Category';
    import addCategory from '../forms/AddCategory.vue';
    import addSubCategory from '../forms/AddSubCategory.vue';
    import addSubcategoryExpense from '../forms/AddSubCategoryExpense.vue';
    import deleteCategory from '../forms/DeleteCategory.vue';
    import deleteSubcategory from '../forms/DeleteSubcategory.vue';
    import viewCategory from '../forms/ViewCategory.vue';
    import viewSubcategory from '../forms/ViewSubCategory.vue';
    import viewBudgetStartDay from '../forms/ViewBudgetStartDay.vue';

    export default {

        components: {
            addCategory,
            addSubCategory,
            addSubcategoryExpense,
            deleteCategory,
            deleteSubcategory,
            viewCategory,
            viewSubcategory,
            viewBudgetStartDay
        },

        data() {
            return {
                categories: [],
                category: [],
                subcategories: [],
                subcategory: [],
                budgetStartDay: [],
                showAddCategoryModal: false,
                showAddSubCategoryModal: false,
                showAddSubcategoryExpenseModal: false,
                showDeleteCategoryModal: false,
                showDeleteSubcategoryModal: false,
                showViewCategoryModal: false,
                showViewSubcategoryModal: false,
                showViewBudgetStartDayModal: false,
            }
        },

        filters: {
            currency(amount) {
                let val = (amount/1).toFixed(2).replace('.', ',');
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
//                return 'R ' + parseInt(amount).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            },

            startDay(date) {
                return parseInt(date.toFixed());
            }
        },

        created() {
            let vm = this;
            Category.all()
                .then(function (response) {
                    vm.categories = response.data[0];
                    vm.budgetStartDay = response.data[1]
                });
        },

        methods: {

            viewBudgetStartDay() {
              this.showViewBudgetStartDayModal = true;
            },

            viewedBudgetStartDay(categories) {
                this.$set(this,'budgetStartDay',categories[1]);
                this.showViewBudgetStartDayModal = false;
                this.$set(this,'categories',categories[0]);
            },

            showSubCategory(id) {
                let subCategories = document.getElementById(id)
                    .querySelectorAll(".selectorClass");
                for (let i = 0; i < subCategories.length; i++) {
                    subCategories[i].classList.remove("toggleSubCategory");
                }
            },

            addedCategory(category) {
                this.categories.unshift(category);
                this.showAddCategoryModal = false;
            },

            addSubCategory(category) {
                this.$set(this.category,0,category);
                this.showAddSubCategoryModal = true;
            },

            addedSubcategory(subcategory) {

                let categoryIndex = this.categories
                    .findIndex(category => category.id == subcategory.category_id);
                let thisCategory = this.categories[categoryIndex];

                thisCategory.subcategory.unshift(subcategory);

                let newCategoryBudget = (parseFloat(thisCategory.categoryBudget) + parseFloat(subcategory.subcategoryBudget)).toFixed(2);

                this.$set(thisCategory,'categoryBudget',newCategoryBudget);

                this.showAddSubCategoryModal = false;
            },

            addSubcategoryExpense(subcategory) {

                this.$set(this.subcategory,0,subcategory);
                this.showAddSubcategoryExpenseModal = true;

            },

            addedSubcategoryExpense(expense) {

                let categoryIndex = this.categories
                    .findIndex(category => category.id == expense.category_id);
                let thisCategory = this.categories[categoryIndex];

                let newCategoryBudgetUsed = (parseFloat(thisCategory.categoryBudgetUsed)+parseFloat(expense.amount)).toFixed(2);
                this.$set(thisCategory,'categoryBudgetUsed',newCategoryBudgetUsed);

                let budgetProgressPerc = thisCategory.categoryBudgetUsed / thisCategory.categoryBudget;
                switch (true) {
                    case budgetProgressPerc <= 0.40:
                        this.$set(thisCategory,'budgetProgress','is-success');
                        break;
                    case budgetProgressPerc <= 0.70:
                        this.$set(thisCategory,'budgetProgress','is-warning');
                        break;
                    default:
                        this.$set(thisCategory,'budgetProgress','is-danger');
                }

                let subcategoryIndex = thisCategory.subcategory
                    .findIndex(subcategory => subcategory.id == expense.subcategory_id);
                let thisSubcategory = thisCategory.subcategory[subcategoryIndex];

                let newBudgetUsed = (parseFloat(thisSubcategory.budgetUsed) + parseFloat(expense.amount)).toFixed(2);
                this.$set(thisSubcategory,'budgetUsed',newBudgetUsed);

                let subcatBudgetProgressPerc = thisSubcategory.budgetUsed / thisSubcategory.subcategoryBudget;
                switch (true) {
                    case subcatBudgetProgressPerc <= 0.40:
                        this.$set(thisSubcategory,'budgetProgress','is-success');
                        break;
                    case subcatBudgetProgressPerc <= 0.70:
                        this.$set(thisSubcategory,'budgetProgress','is-warning');
                        break;
                    default:
                        this.$set(thisSubcategory,'budgetProgress','is-danger');
                }

                this.showAddSubcategoryExpenseModal = false;
            },

            deleteCategory(category) {
                this.$set(this.category,0,category);
                this.showDeleteCategoryModal = true;
            },

            deletedCategory(categoryId) {
                this.categories = this.categories.filter(function (category) {
                    return category.id != categoryId;
                });
                this.showDeleteCategoryModal = false;
            },

            deleteSubcategory(subcategory) {
                this.$set(this.subcategory,0,subcategory);
                this.showDeleteSubcategoryModal = true;
            },

            deletedSubcategory(delSubcategory) {
                let categoryIndex = this.categories
                    .findIndex(category => category.id == this.subcategory[0].category_id);

                let thisCategory = this.categories[categoryIndex];

                thisCategory.subcategory = this.categories[categoryIndex].subcategory
                    .filter(function (subcategory) {
                        return subcategory.id != delSubcategory.id;
                    });

                let newBudgetUsed = (parseFloat(thisCategory.categoryBudgetUsed) - parseFloat(delSubcategory.budgetUsed)).toFixed(2);
                this.$set(thisCategory,'categoryBudgetUsed',newBudgetUsed);

                let newBudget = (parseFloat(thisCategory.categoryBudget) - parseFloat(delSubcategory.subcategoryBudget)).toFixed(2);
                this.$set(thisCategory,'categoryBudget',newBudget);

                this.showDeleteSubcategoryModal = false;
            },

            viewCategory(category){
                this.$set(this.category,0,category);
                this.showViewCategoryModal = true;
            },

            viewedCategory(categoryUpdated) {
                let categoryIndex = this.categories
                    .findIndex(category => category.id === categoryUpdated.id);
                let thisCategory = this.categories[categoryIndex];
                this.$set(thisCategory, 'categoryName', categoryUpdated.categoryName);
                this.showViewCategoryModal = false;

            },

            viewSubcategory(subcategory){
                this.$set(this,'subcategory',subcategory);
                this.showViewSubcategoryModal = true;
            },

            viewedSubcategory(subcategoryUpdated) {
                let categoryIndex = this.categories
                    .findIndex(category => category.id == subcategoryUpdated.category_id);
                let thisCategory = this.categories[categoryIndex];

                let subcategoryIndex = thisCategory.subcategory
                    .findIndex(subcategory => subcategory.id === subcategoryUpdated.id);
                let thisSubcategory = thisCategory.subcategory[subcategoryIndex];

                let newCategoryBudget = parseInt(thisCategory.categoryBudget)
                    - parseInt(thisSubcategory.subcategoryBudget)
                    + parseInt(subcategoryUpdated.subcategoryBudget);

                this.$set(thisCategory, 'categoryBudget', newCategoryBudget);

                this.$set(thisSubcategory, 'subcategoryName', subcategoryUpdated.subcategoryName);
                this.$set(thisSubcategory, 'subcategoryBudget', subcategoryUpdated.subcategoryBudget);

                this.showViewSubcategoryModal = false;
            },

        }
    }
</script>
