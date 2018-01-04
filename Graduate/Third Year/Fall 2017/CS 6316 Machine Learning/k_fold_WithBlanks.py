'''
Following is an example function of k-fold cross validation. 

- In this code, you are given the dataset, x_train and y_train. And you try to find the 
    best model with k-fold cross validation.
- There are 10 blanks (underlined) for you to fill out.
- The goal is not to write out the perfect code, but to understand how k-fold cross 
    validation is actually implemented by studying an example.
- Please also note that this is mostly pseudo-code although much of this code is probably
    runnable code :)
'''

# <<< Your Name >>>
# <<< Your UVa Computing ID >>>

def k_fold_cross_validation(x_train, y_train)
# x_train and y_train contains all the training data
# initial best_model and best_score
    best_model 		# variable unassigned at present
    best_score = 0	# variable initialized to 0
    for each model:
        num_folds = 3  # the number of folds
        subset_size = len(x_train) / _________  # subset_size = size of each fold of data
        
        test_model = sklearn.svm.SVC() or other models  
		# SVC stands for Support Vector Classification. It is a built-in class in 
		# sklearn. We can initialize the model we want to test in this loop
        correct = 0 # keeps the number of correct predictions
    
        for i in range(________):
            # In k-fold cross validation, we split the dataset into k folds. We use one 
			# fold of data to test the model, and use the rest of the data to train the 
			# model. The following 4 lines of code shows how we extract particular fold
			# of data from the whole data set.   For example, if we want to use the i-th
			# fold of data to test, given the subset_size, the index of i-th fold data 
			# is from i * subset_size to (i + 1) * subset_size
            
            training_this_round_xVal = x_train[:i * subset_size] + x_train[(i + 1) * subset_size:]
            training_this_round_yVal = y_train[:i * subset_size] + y_train[(i + 1) * subset_size:]
            testing_this_round_xVal = x_train[________:][:subset_size]
            testing_this_round_yVal = y_train[________:][:subset_size]
            
            # use training data to train the model
            test_model.fit(________,________)
            
            # predict using trained model
            y_predict = test_model.predict(________)
            
            # sum up the correct predicted data
            for i in range(0, len(y_predict)):
                if (y_predict[i] == ________):  # prediction == actual?
                    correct += 1
                    
        # save the best score and best model so far
        if (float(correct)  / len(y_train) > best_score): # If current score better...
            best_score = float(________)  / len(y_train)  # ... save the better score
            best_model = ________ # ... and save current model that resulted in best score
        
    return best_score, best_model




                
