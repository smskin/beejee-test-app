{extends file='layout/layout.tpl'}

{block name=js}
    <!--suppress HtmlUnknownTarget -->
    <script type="text/javascript" src="/assets/pages/login.js"></script>
{/block}

{block name=body}
    <div id="loginForm">
        <validation-observer ref="form" v-slot="{ handleSubmit }" slim>
            <form class="form-signin" @submit.prevent="handleSubmit(onSubmit)">
                <h1 class="h3 mb-3 font-weight-normal">Вход</h1>
                <label class="sr-only">Имя пользователя</label>
                <validation-provider vid="userName" name="имя пользователя" v-slot="{ errors, classes }" rules="required" tag="div" slim>
                    <!--suppress HtmlFormInputWithoutLabel -->
                    <input
                            v-model="userName"
                            class="form-control"
                            placeholder="Имя пользователя"
                            :class="classes"
                            autofocus>
                    {literal}
                        <span class="invalid-feedback" role="alert">{{ errors[0] }}</span>
                    {/literal}
                </validation-provider>
                <label class="sr-only">Имя пользователя</label>
                <validation-provider vid="password" name="пароль" v-slot="{ errors, classes }" rules="required" tag="div" slim>
                    <!--suppress HtmlFormInputWithoutLabel -->
                    <input
                            v-model="password"
                            class="form-control"
                            placeholder="Пароль"
                            :class="classes"
                            autofocus>
                    {literal}
                        <span class="invalid-feedback" role="alert">{{ errors[0] }}</span>
                    {/literal}
                </validation-provider>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
            </form>
        </validation-observer>
    </div>
{/block}