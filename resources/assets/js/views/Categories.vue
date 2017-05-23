<template>
    <div class="columns">

        <addCategory v-if="showAddCategoryModal" @completed="addedCategory" @close="showAddCategoryModal = false"></addCategory>
        <addSubCategory v-if="showAddSubCategoryModal" @completed="addedSubcategory" @close="showAddSubCategoryModal = false" :category="category"></addSubCategory>

        <deleteCategory v-if="showDeleteCategoryModal" @completed="deletedCategory" @close="showDeleteCategoryModal = false" :category="category"></deleteCategory>
        <deleteSubcategory v-if="showDeleteSubcategoryModal" @completed="deletedSubcategory" @close="showDeleteSubcategoryModal = false" :subcategory="subcategory"></deleteSubcategory>

        <div class="column">
            <div class="message is-warning">
                <div class="message-header">
                    Category Details
                    <a class="button is-warning is-inverted is-outlined" @click="showAddCategoryModal = true" style="text-decoration: none">Add Category</a>
                </div>
                <div class="message-body">
                    <div v-for="category in categories" :id="category.id">
                        <div class="columns">
                            <div class="column is-1">
                                <h2>{{ category.categoryName }}</h2>
                            </div>
                            <div class="column" style="padding-top: 16px">
                                <progress class="progress is-medium" value="15" max="100">15%</progress>
                            </div>
                            <div class="column is-1">
                                <a style="text-decoration: none" @click="toggleSubCategory(category.id)">
                                    <span class="icon is-small">
                                      <i class="fa fa-arrow-circle-down"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="addSubCategory(category)">
                                    <span class="icon is-small">
                                      <i class="fa fa-plus-circle"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="showAddSubCategoryModal = true">
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
                        <div class="columns selectorClass toggleSubCategory"
                             v-for="subcategory in category.subcategory">
                            <div class="column is-2">
                                <div class="level-right">{{ subcategory.subcategoryName }}</div>
                            </div>
                            <div class="column" style="padding-top: 17px">
                                <progress class="progress is-success" value="15" max="100">15%</progress>
                            </div>
                            <div class="column is-1">
                                    <span class="icon is-small">
                                    </span>
                                <a style="text-decoration: none" @click="showAddSubCategoryModal = true">
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
    import deleteSubcategory from '../forms/DeleteSubcategory.vue'

    export default {

        components: {
            addCategory,
            addSubCategory,
            deleteCategory,
            deleteSubcategory
        },

        data() {
            return {
                categories: [],
                category: [],
                subcategories: [],
                subcategory: [],
                showAddCategoryModal: false,
                showAddSubCategoryModal: false,
                showDeleteCategoryModal: false,
                showDeleteSubcategoryModal: false,
            }
        },

        created() {
            Category.all()
                .then(({data}) => this.categories = data);
        },
        methods: {
            addedCategory(category) {
                console.log(category);
                this.categories.unshift(category);
                this.showAddCategoryModal = false;
            },

            toggleSubCategory(id) {
                var subCategories = document.getElementById(id)
                    .getElementsByClassName("selectorClass");
                for (var i = 0; i < subCategories.length; i++) {
                    subCategories[i].classList.toggle("toggleSubCategory");
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
                this.subcategories = this.subcategories.filter(function (subcategory) {
                    return subcategory.id != subcategoryId;
                });
                this.showDeleteSubcategoryModal = false;
            }
        }
    }
</script>
