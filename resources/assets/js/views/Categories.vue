<template>
    <div class="columns">

        <addCategory v-if="showAddCategoryModal" @completed="addedCategory" @close="showAddCategoryModal = false"></addCategory>
        <addSubCategory v-if="showAddSubCategoryModal" @completed="addedSubcategory" @close="showAddSubCategoryModal = false" :category="category"></addSubCategory>

        <deleteCategory v-if="showDeleteCategoryModal" @completed="deletedCategory" @close="showDeleteCategoryModal = false" :category="category"></deleteCategory>
        <viewCategory v-if="showViewCategoryModal" @completed="viewedCategory" @close="showViewCategoryModal = false" :category="category"></viewCategory>

        <deleteSubcategory v-if="showDeleteSubcategoryModal" @completed="deletedSubcategory" @close="showDeleteSubcategoryModal = false" :subcategory="subcategory"></deleteSubcategory>
        <viewSubcategory v-if="showViewSubcategoryModal" @completed="viewedSubcategory" @close="showViewSubcategoryModal = false" :subcategory="subcategory"></viewSubcategory>

        <div class="column">
            <div class="message is-primary">
                <div class="message-header">
                    Category Details <br/>
                    Your budget starts on day {{ budgetStartDay }} of the month.
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
                                <!--<a style="text-decoration: none" @click="toggleSubCategory(category.id)">
                                    <span class="icon is-small">
                                      <i class="fa fa-arrow-circle-down"></i>
                                    </span>
                                </a>-->
                                <a style="text-decoration: none" @click="addSubCategory(category)">
                                    <span class="icon is-small">
                                      <i class="fa fa-plus-circle"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="viewCategory(category)">
                                    <span class="icon is-small">
                                      <i class="fa fa-info-circle"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="deleteCategory(category)">
                                    <span class="icon is-small">
                                      <i class="fa fa-times-circle"></i>
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
                                    <span class="icon is-small">
                                    </span>
                                <a style="text-decoration: none" @click="viewSubcategory(subcategory)">
                                    <span class="icon is-small">
                                      <i class="fa fa-info-circle"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="deleteSubcategory(subcategory)">
                                    <span class="icon is-small">
                                      <i class="fa fa-times-circle"></i>
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
    import deleteCategory from '../forms/DeleteCategory.vue';
    import deleteSubcategory from '../forms/DeleteSubcategory.vue';
    import viewCategory from '../forms/ViewCategory.vue';
    import viewSubcategory from '../forms/ViewSubCategory.vue';

    export default {

        components: {
            addCategory,
            addSubCategory,
            deleteCategory,
            deleteSubcategory,
            viewCategory,
            viewSubcategory
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
                showDeleteCategoryModal: false,
                showDeleteSubcategoryModal: false,
                showViewCategoryModal: false,
                showViewSubcategoryModal: false,
            }
        },

        filters: {
            currency(amount) {
                return 'R ' + parseInt(amount).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            }
        },

        created() {
            Category.all()
                .then(({data}) => this.categories = data[0]);
            Category.all()
                .then(({data}) => this.budgetStartDay = data[1]);
        },
        methods: {

            addedCategory(category) {
                this.categories.unshift(category);
                this.showAddCategoryModal = false;
            },

//            toggleSubCategory(id) {
//                var subCategories = document.getElementById(id)
//                    .getElementsByClassName("selectorClass");
//                for (var i = 0; i < subCategories.length; i++) {
//                    subCategories[i].classList.toggle("toggleSubCategory");
//                }
//            },

            showSubCategory(id) {
                var subCategories = document.getElementById(id)
                    .querySelectorAll(".selectorClass");
                for (var i = 0; i < subCategories.length; i++) {
                    subCategories[i].classList.remove("toggleSubCategory");
                }
            },

            addSubCategory(category_details) {
                this.$set(this.category,0,category_details);
                this.showAddSubCategoryModal = true;
                            },

            addedSubcategory(subcategory) {
                var categoryIndex = this.categories
                    .findIndex(category => category.id == subcategory.category_id);
                var thisCategory = this.categories[categoryIndex];
                thisCategory.subcategory.unshift(subcategory);
                this.showAddSubCategoryModal = false;
//                this.showSubCategory(subcategory.category_id);
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

            deletedSubcategory(subcategoryId) {
                let categoryIndex = this.categories
                    .findIndex(category => category.id == this.subcategory[0].category_id);

                this.categories[categoryIndex].subcategory = this.categories[categoryIndex].subcategory
                    .filter(function (subcategory) {
                        return subcategory.id != subcategoryId;
                    });

                this.showDeleteSubcategoryModal = false;
            },

            viewCategory(category){
                this.$set(this.category,0,category);
                this.showViewCategoryModal = true;
            },

            viewedCategory(categoryUpdated) {
                let categoryIndex = this.categories
                    .findIndex(category => category.id === categoryUpdated[0].id);
                this.$set(this.categories, categoryIndex, categoryUpdated[0]);
                this.showViewCategoryModal = false;

            },

            viewSubcategory(subcategory){
                this.$set(this.subcategory,0,subcategory);
                this.showViewSubcategoryModal = true;
            },

            viewedSubcategory(subcategoryUpdated) {
                let categoryIndex = this.categories
                    .findIndex(category => category.id == subcategoryUpdated[0].category_id);
                let thisCategory = this.categories[categoryIndex];
                let subcategoryIndex = thisCategory.subcategory
                    .findIndex(subcategory => subcategory.id === subcategoryUpdated[0].id);
                this.$set(thisCategory.subcategory, subcategoryIndex, subcategoryUpdated[0]);
                this.showViewSubcategoryModal = false;
            },

        }
    }
</script>
