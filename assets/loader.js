function WhiskLoader() {
	/**
	 * Promise-based script loader
	 * @param {string} url
	 * @param {object=} attr
	 * @returns {Promise}
	 */
	const loader = (url, attr) => new Promise((resolve, reject) => {
		const script = window.document.createElement('script');
		script.src = url;
		script.async = true;
		script.crossOrigin = 'anonymous';
		attr = attr || {};

		for (const attrName in attr) {
			script[attrName] = attr[attrName];
		}

		script.addEventListener('load', () => {
			resolve(script);
		}, false);

		script.addEventListener('error', () => {
			reject(script);
		}, false);

		window.document.body.appendChild(script);
	});

	/**
	 * Loads scripts asynchronously
	 * @param {string|string[]} urls
	 * @param {object=} attr Other script tag attributes
	 * @returns {Promise}
	 */
	this.load = (urls, attr) => {
		if (!Array.isArray(urls)) {
			urls = [urls];
		}

		return Promise.all(urls.map(url => loader(url, attr)));
	}

	/**
	 * Loads scripts asynchronously. It supports multiple url arguments, so each one will be loaded right after the
	 * previous is loaded. This is a way of chaining dependency loading.
	 *
	 * @param {string|string[]} urls, ...
	 * @returns {Promise}
	 */
	this.loadChain = function (urls) {
		const args = Array.isArray(arguments) ? arguments : Array.prototype.slice.call(arguments);
		const p = this.require(args.shift());
		const self = this;
		return args.length ? p.then(() => {
			self.requireChain(...args);
		}) : p;
	}
}

// Inspiration: https://gist.github.com/itsjavi/93cc837dd2213ec0636a
