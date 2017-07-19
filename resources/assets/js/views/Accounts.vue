<template>
    <div class="columns">

        <addAccount v-if="showAddAccountModal" @completed="addedAccount"
                    @close="showAddAccountModal = false"></addAccount>
        <deleteAccount v-if="showDeleteAccountModal" @completed="deletedAccount" @close="showDeleteAccountModal = false"
                       :account="account"></deleteAccount>
        <viewAccount v-if="showViewAccountModal" @completed="viewedAccount" @close="showViewAccountModal = false"
                     :account="account"></viewAccount>

        <div class="message is-warning">
            <div class="message-header">
                Accounts details
                <a class="button is-warning is-inverted is-outlined" @click="showAddAccountModal = true"
                   style="text-decoration: none">Add Account</a>
            </div>
            <div class="message-body">

                <div class="box">

                    <table class="table is-warning">
                        <thead>
                        <tr>
                            <th class="is-narrow">Account</th>
                            <th class="is-narrow">Account Type</th>
                            <th class="is-narrow">Account Balance</th>
                            <th class="is-narrow"></th>
                        </tr>
                        </thead>
                        <tfoot class="is-warning">
                        <tr>
                            <td></td>
                            <td>Total</td>
                            <td>{{ accountsTotal | currency }}</td>
                            <td></td>
                        </tr>
                        </tfoot>
                        <tbody>
                        <tr v-for="account in accounts" :key="account.id">
                            <td class="is-narrow">{{ account.accountName }}</td>
                            <td class="is-narrow">{{ account.accountType }}</td>
                            <td class="is-narrow">{{ account.balance | currency }}</td>
                            <td>
                                <a style="text-decoration: none" @click="viewAccount(account)">
                                    <span class="icon is-small">
                                      <i class="fa fa-info-circle"></i>
                                    </span>
                                </a>
                                <a style="text-decoration: none" @click="deleteAccount(account)">
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
    import Account from '../models/Account';

    import addAccount from '../forms/AddAccount.vue';
    import deleteAccount from '../forms/DeleteAccount.vue';
    import viewAccount from '../forms/ViewAccount.vue';

    export default {

        components: {
            addAccount,
            deleteAccount,
            viewAccount
        },

        data() {
            return {
                accounts: [],
                account: [],
                showAddAccountModal: false,
                showDeleteAccountModal: false,
                showViewAccountModal: false,
            }

        },

        filters: {
            currency(amount) {
                let val = (amount/1).toFixed(2).replace('.', ',');
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");

            }
        },

        created() {
            Account.all()
                .then(({data}) => this.accounts = data);
        },

        computed: {
            accountsTotal: function () {
                return this.accounts.reduce(function (total, account) {
                    return total + +account.balance
                }, 0)
            }
        },

        methods: {
            addedAccount(account) {
                this.accounts.unshift(account);
                this.showAddAccountModal = false;
            },

            deleteAccount(account) {
                this.$set(this.account, 0, account);
                this.showDeleteAccountModal = true
            },

            deletedAccount(accountId) {
                this.accounts = this.accounts.filter(function (account) {
                    return account.id != accountId;
                });
                this.showDeleteAccountModal = false;
            },

            viewAccount(account) {
                this.$set(this, 'account', account);
                this.showViewAccountModal = true;
            },

            viewedAccount(accountUpdated) {
                let accountIndex = this.accounts
                    .findIndex(account => account.id === accountUpdated[0].id);
                this.$set(this.accounts, accountIndex, accountUpdated[0]);
                this.showViewAccountModal = false;
            }
        }

    }
</script>
