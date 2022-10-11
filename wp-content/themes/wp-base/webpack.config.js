'use strict';

const path = require('path')
const AssetsPlugin = require('assets-webpack-plugin')
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin"); // This plugin uses cssnano to optimize and minify your CSS.
const TerserPlugin = require("terser-webpack-plugin"); // This plugin uses terser to minify/minimize your JavaScript.
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const DEV = process.env.NODE_ENV === 'development';
const WebpackMessages = require('webpack-messages'); //Beautifully format Webpack messages throughout your bundle lifecycle(s)
//const WebpackAssetsManifest = require('webpack-assets-manifest');

module.exports = {
  mode: DEV ? 'development' : 'production',
  entry: {
    main: ['./src/main.js'],
    bootstrap: ['./src/bootstrap.js'],
    libs: ['./src/libs.js'],
  },
  output: {
    path: path.join(__dirname, './build'),
    filename: 'js/[name].bundle.js',
    clean: true,
  },

  devtool: DEV ? 'inline-source-map' : 'eval',
  stats: 'none',

  module: {
    rules: [
      {
        test: /\.js$/,
        loader: "babel-loader"
      },
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,

          {
            loader: "css-loader",
            options: {
              sourceMap: DEV
            }
          },


          {
            loader: "postcss-loader",
            options: {
              sourceMap: DEV
            }
          },
          {
            loader: "sass-loader",
            options: {
              sourceMap: DEV
            }
          },
        ],
      },
      {
        test: /\.(png|svg|jpg|jpeg|gif)$/i,
        type: "asset/resource",
        generator: {
          filename: "images/[name][ext]",
        },
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/i,
        type: "asset/resource",
        generator: {
          filename: "fonts/[name][ext]",
        },
      },
    ]
  },

  optimization: {
    minimize: !DEV,
    minimizer: [
      new CssMinimizerPlugin(),
      new TerserPlugin(),
    ],
  },

  plugins: [
    
    new MiniCssExtractPlugin({
      filename: "css/[name].bundle.css",
    }),
    // new WebpackAssetsManifest({
    //   // Options go here
    //   output: './manifest.json',
    // }),
    DEV &&
    new BrowserSyncPlugin({
      host: 'http://wordpress-base-local.test/',
      proxy: 'http://wordpress-base-local.test/',
      port: 3000,
      files: [
        './**/*.php',
        './src/**/*.js',
        './src/**/*.scss',
      ],
    }),
      new WebpackMessages({
      name: 'webpack',
      logger: str => console.log(`---> ${str}`)
    }),
    new AssetsPlugin({
      //path: './build',
      fullPath: true,
      removeFullPathAutoPrefix: true,
      useCompilerPath: true,
      prettyPrint: true

    }),
  ].filter(Boolean),
}
