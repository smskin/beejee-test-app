{extends file='layout/layout.tpl'}

{block name=js}
    <!--suppress HtmlUnknownTarget -->
    <script type="text/javascript" src="/assets/pages/home.js"></script>
{/block}

{block name=body}
    <div class="container">
        <div id="tasks">
            <div class="row mt-2 mb-2">
                {literal}
                    <div class="col-lg-11 col-sm-12">
                        <task-filter
                                :filter="filter"
                                :filter-direct="filterDirect"
                                v-on:input="onChangeFilter"
                        ></task-filter>
                    </div>
                {/literal}
                <div class="col-lg-1 col-sm-12 text-right mt-lg-0 mt-sm-2">
                    <a v-show="isAuthorized" style="display: none" href="#" class="btn btn-danger" v-on:click="logout">Выйти</a>
                    <a v-show="isGuest" href="/auth/login" class="btn btn-primary">Войти</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="list-group">
                        <task-item
                                v-for="item in tasks"
                                :value="item"
                                :key="item.id"
                                :user="user"
                                v-on:input="updateTask"
                        ></task-item>
                    </ul>
                </div>
            </div>
            <div v-if="pagination.pages > 1" class="row mt-1">
                <div class="col-12">
                    <pagination
                            :page="pagination.page"
                            :pages="pagination.pages"
                            v-on:change-page="onChangePage"
                    ></pagination>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <create-task-form
                            v-on:task-created="onTaskCreated"
                    ></create-task-form>
                </div>
            </div>
        </div>
    </div>
{/block}