/**
 * Created by smskin on 21.09.17.
 */
const
    path = require('path'),
    webpack = require('webpack'),
    VueLoaderPlugin = require('vue-loader/lib/plugin');

const config = {
    targetDir: './public/assets',
};

// noinspection JSUnresolvedVariable
module.exports = {
    output: {
        path: path.resolve(__dirname, config.targetDir),
        publicPath: "/assets/"
    },
    entry: {
        app: './resources/assets/app/index.js',
        'pages/login': './resources/assets/pages/login/index.js',
        'pages/home': './resources/assets/pages/home/index.js'
    },
    resolve: {
        alias: {
            'modules': path.resolve(__dirname, 'resources/assets/modules/'),
            vue: 'vue/dist/vue.esm.js'
        }
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery',
            'window.$': 'jquery'
        }),
        new webpack.HashedModuleIdsPlugin({
            hashFunction: 'md4',
            hashDigest:'base64',
            hashDigestLength: 8,
        }),
        new VueLoaderPlugin()
    ],
    optimization: {
        splitChunks: {
            chunks: 'async',
            minSize: 30000,
            maxSize: 0,
            minChunks: 1,
            maxAsyncRequests: 6,
            maxInitialRequests: 4,
        }
    },
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    // Creates `style` nodes from JS strings
                    'style-loader',
                    // Translates CSS into CommonJS
                    'css-loader',
                    // Compiles Sass to CSS
                    'sass-loader',
                ],
            },
            {
                test: /\.css$/i,
                use: ['style-loader', 'css-loader'],
            },
            {
                test: require.resolve('jquery'),
                use: [
                    {
                        loader: 'expose-loader',
                        options: '$'
                    },
                    {
                        loader: 'expose-loader',
                        options: 'jQuery'
                    }
                ]
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
            }
        ]
    },
};