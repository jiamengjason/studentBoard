const path = require("path");

function resolve(dir) {
  return path.join(__dirname, dir);
}
module.exports = {
  lintOnSave: process.env.NODE_ENV !== "production",

  devServer: {
    port: 8080,
    disableHostCheck: true,
    proxy: {
      "/v1": {
        // 代理api
        target: "http://118.190.25.177", // 服务器api地址-
        changeOrigin: true, // 是否跨域
        ws: true, // proxy websockets
        pathRewrite: {
          // 重写路径
          "^/v1": "/v1"
        }
      }
    }
  },
  chainWebpack: config => {
    config.optimization.minimize(true);
    // config.optimization.splitChunks({
    //   maxSize: 500,
    //   chunks: 'all'
    // })
    config.optimization.splitChunks({
      // chunks: 'async',
      // minSize: 300,

      // minChunks: 1,
      cacheGroups: {
        vendors: {
          name: "chunkstark-vendors",
          test: /[\\/]node_modules[\\/]/,
          priority: -10,
          chunks: "initial"
        },
        common: {
          name: "chunk-common",
          minChunks: 2,
          maxSize: 100,
          priority: -20,
          chunks: "initial",
          reuseExistingChunk: true
        }
      }
    });
    // config.externals({
    //   vue: 'vue',
    //   vuex: 'vuex',
    //   'vue-router': "'vue-router'",
    //   'element-ui': "'element-ui'"
    // })
    config.resolve.alias
      .set("@", resolve("src"))
      .set("assets", resolve("src/assets"))
      .set("mixin", resolve("src/mixin"))
      .set("apis", resolve("src/apis"))
      .set("components", resolve("src/components"));
  }
};
