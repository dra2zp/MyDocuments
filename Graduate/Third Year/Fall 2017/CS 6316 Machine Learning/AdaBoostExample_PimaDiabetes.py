# -*- coding: utf-8 -*-
"""
Adaboost Example using Pima Indians Diabetes data set
AdaBoostExample_PimaDiabetes.py

Info about data set:
https://archive.ics.uci.edu/ml/machine-learning-databases/pima-indians-diabetes/pima-indians-diabetes.names
    
"""

# AdaBoost Classification
import pandas
from sklearn import model_selection
from sklearn.ensemble import AdaBoostClassifier
# Using Pima Indians Diabetes Database (from UCI Machine Learning Repository)
url = "https://archive.ics.uci.edu/ml/machine-learning-databases/pima-indians-diabetes/pima-indians-diabetes.data"
names = ['preg', 'plas', 'pres', 'skin', 'test', 'mass', 'pedi', 'age', 'class']
dataframe = pandas.read_csv(url, names=names)
array = dataframe.values
X = array[:,0:8]
Y = array[:,8]
seed = 7
num_trees = 30  # construction of 30 weak learners
# Using K-fold cross validation (10 folds)
kfold = model_selection.KFold(n_splits=10, random_state=seed)
# Using AdaBoost Classifier, using a sequence of 30 weak learners
model = AdaBoostClassifier(n_estimators=num_trees, random_state=seed)
# Result: mean estimate of classification accuracy
results = model_selection.cross_val_score(model, X, Y, cv=kfold)
print("Classification accuracy for each fold: \n", results)
print("")
print("Mean estimate of classification accuracy: %5.3f" % results.mean())
# Example output: Mean estimate of classification accuracy: 0.760