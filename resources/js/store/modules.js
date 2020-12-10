const requireModule = require.context(
	// The relative path of the modules folder
	'../components/',
	// Whether or not to look in subfolders
	true,
	// The regular expression used to match base component filenames
	/store\/\w+\.js/
)

let modules = {}

requireModule.keys().forEach(fileName => {
  // Get module config
	const fileToArray = fileName.replace(/\.|js$/g, '').split('/')
	const name = fileToArray[fileToArray.length - 1]
	const moduleConfig = requireModule(fileName).default
	
	modules[name] = moduleConfig
})

export default modules