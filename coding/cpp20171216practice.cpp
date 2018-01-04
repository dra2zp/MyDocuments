#include <iostream>
#include <vector>
#include <string>
#include <sstream>
#include <stdlib.h>
using namespace std;

// fibonacci is a function that takes in an int k and returns the first k
// numbers in the fibonacci sequence
string fibonacci(int k) {
  if (k < 1) {
    return "";
  }
  else if (k == 1) {
    return "0";
  }
  else if (k == 2) {
    return "0, 1";
  }
  else {
    int num1 = 0;
    int num2 = 1;
    int count = 3;
    int sum = num1 + num2;
    string list = to_string(num1) + ", " + to_string(num2) + ", " +
      to_string(sum);
    while (count < k) {
      num1 = num2;
      num2 = sum;
      sum = num1 + num2;
      list += ", " + to_string(sum);
      count++;
    }
    return list;
  }
}

// pascal is a function that takes in an int k and returns the k-th row in the
// pascal triangle
string pascal(int k) {
  if (k < 1) {
    return "";
  }
  else if (k == 1) {
    return "1";
  }
  else if (k == 2) {
    return "1 1";
  }
  else {
    int countArrays = 3;
    vector< vector<int> > total;
    int countNum = 0;
    int countArray = 0;
    vector<int> array;
    while (countNum < k) {
      array.push_back(1);
      countNum++;
    }
    total.push_back(array);
    countArray++;
    while (countArray <= k / 2) {
      countNum = 0;
      array = {};
      int num = 1;
      while (countNum < k - countArray) {
	array.push_back(num);
	num += total.at(countArray - 1).at(countNum + 1);
	countNum++;
      }
      total.push_back(array);
      countArray++;
    }
    string list = "";
    int totalCount = 0;
    int arrayCount = k - 1;
    while (totalCount < (k / 2) + 1) {
      list += to_string(total.at(totalCount).at(arrayCount)) + " ";
      totalCount++;
      arrayCount--;
    }
    if (k % 2 == 1) {
      totalCount = (k / 2) - 1;
    }
    else {
      totalCount = (k / 2) - 2;
    }
    arrayCount = k - 1 - totalCount;
    while (totalCount > -1) {
      list += to_string(total.at(totalCount).at(arrayCount)) + " ";
      totalCount--;
      arrayCount++;
    }
    return list;
  }
}

// pigLatin is a function that takes a string str and returns the str translated
// in pig latin
string pigLatin(string str) {
  vector<string> strArray;
  int position = 0;
  while (str[position] != '\0') {
    string word = "";
    while (str[position] != '\0' && str[position] != ' ') {
      word += str[position];
      position++;
    }
    strArray.push_back(word);
    if (str[position] == ' ') {
      position++;
    }
  }
  string translated = "";
  vector<string> translatedPhrase;
  for (int i = 0; i < strArray.size(); i++) {
    translated = "";
    if (strArray.at(i).length() < 2) {
      translated = strArray.at(i);
    }
    else {
      for (int j = 1; j < strArray.at(i).length(); j++) {
	translated += strArray.at(i)[j];
      }
      translated += strArray.at(i)[0];
      translated += "ay";
    }
    translatedPhrase.push_back(translated);
  }
  string pig = "";
  for (int i = 0; i < translatedPhrase.size(); i++) {
    pig += translatedPhrase.at(i);
    pig += " ";
  }
  return pig;
}

// wordFrame is a function that takes in a vector<string> stringList and returns
// each string in stringList with a border of asterisks (*) around it
void wordFrame(vector<string> stringList) {
  int k = stringList.size();
  int longest = 0;
  for (int i = 0; i < k; i++) {
    if (stringList.at(i).length() > longest) {
      longest = stringList.at(i).length();
    }
  }
  int frameLength = longest + 4;
  for (int i = 0; i < frameLength - 1; i++) {
    cout << "*";
  }
  cout << "*\n";
  for (int i = 0; i < k; i++) {
    cout << "* " << stringList.at(i);
    for (int j = 0; j < frameLength - stringList.at(i).length() - 3; j++) {
      cout << " ";
    }
    cout << "*\n";
  }
  for (int i = 0; i < frameLength - 1; i++) {
    cout << "*";
  }
  cout << "*" << endl;
}

// digitList is a function that takes in an int k and returns all the digits in
// k as an array
vector<int> digitList(int k) {
  string number = to_string(k);
  vector<int> list;
  for (int i = 0; i < number.length(); i++) {
    stringstream ss;
    ss << number[i];
    int num = 0;
    ss >> num;
    list.push_back(num);
  }
  return list;
}

// rotateList is a function that takes in a vector<int> list and an int k and
// returns the list rotated by k elements
vector<int> rotateList(vector<int> list, int k) {
  vector<int> rotated;
  int index = k;
  int size = list.size();
  while (index < size) {
    rotated.push_back(list.at(index));
    index++;
  }
  index = 0;
  while (index < k) {
    rotated.push_back(list.at(index));
    index++;
  }
  return rotated;
}

// mergeLists is a recursive function that takes in two vector<int> list1 and
// list2 and an initially empty vector<int> merged and returns a single sorted
// list merged
vector<int> mergeLists(vector<int> list1, vector<int> list2,
		       vector<int> &merged) {
  int size1 = list1.size();
  int size2 = list2.size();
  int sizeMerged = merged.size();
  if (size1 == 0 && size2 == 0) {
    return merged;
  }
  else if (size1 == 0) {
    for (int i = 0; i < size2; i++) {
      merged.push_back(list2.at(i));
    }
    return merged;
  }
  else if (size2 == 0) {
    for (int i = 0; i < size1; i++) {
      merged.push_back(list1.at(i));
    }
    return merged;
  }
  else {
    if (list1.at(0) < list2.at(0)) {
      merged.push_back(list1.at(0));
      vector<int> newList1;
      for (int i = 1; i < size1; i++) {
	newList1.push_back(list1.at(i));
      }
      list1 = newList1;
    }
    else if (list2.at(0) < list1.at(0)) {
      merged.push_back(list2.at(0));
      vector<int> newList2;
      for (int i = 1; i < size1; i++) {
	newList2.push_back(list2.at(i));
      }
      list2 = newList2;
    }
    else {
      merged.push_back(list1.at(0));
      merged.push_back(list2.at(0));
      vector<int> newList1;
      vector<int> newList2;
      for (int i = 1; i < size1; i++) {
	newList1.push_back(list1.at(i));
      }
      for (int i = 1; i < size2; i++) {
	newList2.push_back(list2.at(i));
      }
      list1 = newList1;
      list2 = newList2;
    }
    return mergeLists(list1, list2, merged);
  }
}

// isPalindrome is a function that takes in a string input and returns true if
// input is a palindrome and false otherwise
bool isPalindrome(string input) {
  int first = 0;
  int last = input.size() - 1;
  while (first < last) {
    if (input[first] != input[last]) {
      return false;
    }
    first++;
    last--;
  }
  return true;
}

// guessPassword is a function that takes in a string password and returns an
// int counter showing the number of guesses it would take to guess that
// password using a brute-force technique
int guessPassword(string password) {
  vector<char> characters = {'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')'};
  int counter = 0;
  int size = characters.size();
  string str = "";
  for (int i = 0; i < size; i++) {
    str += characters.at(i);
    for (int j = 0; j < size; j++) {
      str += characters.at(j);
      for (int k = 0; k < size; k++) {
	str += characters.at(k);
	for (int l = 0; l < size; l++) {
	  str += characters.at(l);
	  counter++;
	  cout << str << endl;
	  if (str == password) {
	    return counter;
	  }
	  string newStr = "";
	  for (int m = 0; m < 3; m++) {
	    newStr += str[m];
	  }
	  str = newStr;
	}
	string newStr = "";
	for (int n = 0; n < 2; n++) {
	  newStr += str[n];
        }
	str = newStr;
      }
      string newStr = "";
      for (int o = 0; o < 1; o++) {
	newStr += str[o];
      }
      str = newStr;
    }
    str = "";
  }
  return -1;
}

// numMoves is a function that takes in an int dimension, a vector<int> queenPos
// of size 2 that contains two elements for the queen's x- and y-position
// (respectively), and a vector< vector<int> > bad that contains a list of
// (x, y)-pairs that are invalid for the queen to travel to
int numMoves(int dim, vector<int> queenPos, vector< vector<int> > bad) {
  int numBad = bad.size();
  int queenXpos = queenPos[0];
  int queenYpos = queenPos[1];
  vector< vector<int> > possible;
  vector<int> weights;
  int xTemp;
  int yTemp;
  int count;
  // west
  xTemp = queenXpos;
  yTemp = queenYpos;
  count = 0;
  while (xTemp > 1) {
    xTemp--;
    possible.push_back({xTemp, yTemp});
    count++;
  }
  int countW = count;
  while (count > 0) {
    weights.push_back(count);
    count--;
  }
  // east
  xTemp = queenXpos;
  yTemp = queenYpos;
  count = 0;
  while (xTemp < dim) {
    xTemp++;
    possible.push_back({xTemp, yTemp});
    count++;
  }
  int countE = count;
  while (count > 0) {
    weights.push_back(count);
    count--;
  }
  // south
  xTemp = queenXpos;
  yTemp = queenYpos;
  count = 0;
  while (yTemp > 1) {
    yTemp--;
    possible.push_back({xTemp, yTemp});
    count++;
  }
  int countS = count;
  while (count > 0) {
    weights.push_back(count);
    count--;
  }
  // north
  xTemp = queenXpos;
  yTemp = queenYpos;
  count = 0;
  while (yTemp < dim) {
    yTemp++;
    possible.push_back({xTemp, yTemp});
    count++;
  }
  int countN = count;
  while (count > 0) {
    weights.push_back(count);
    count--;
  }
  // southwest
  xTemp = queenXpos;
  yTemp = queenYpos;
  count = 0;
  while (xTemp > 1 && yTemp > 1) {
    xTemp--;
    yTemp--;
    possible.push_back({xTemp, yTemp});
    count++;
  }
  int countSW = count;
  while (count > 0) {
    weights.push_back(count);
    count--;
  }
  // northeast
  xTemp = queenXpos;
  yTemp = queenYpos;
  count = 0;
  while (xTemp < dim && yTemp < dim) {
    xTemp++;
    yTemp++;
    possible.push_back({xTemp, yTemp});
    count++;
  }
  int countNE = count;
  while (count > 0) {
    weights.push_back(count);
    count--;
  }
  // northwest
  xTemp = queenXpos;
  yTemp = queenYpos;
  count = 0;
  while (xTemp > 1 && yTemp < dim) {
    xTemp--;
    yTemp++;
    possible.push_back({xTemp, yTemp});
    count++;
  }
  int countNW = count;
  while (count > 0) {
    weights.push_back(count);
    count--;
  }
  // southeast
  xTemp = queenXpos;
  yTemp = queenYpos;
  count = 0;
  while (xTemp < dim && yTemp > 1) {
    xTemp++;
    yTemp--;
    possible.push_back({xTemp, yTemp});
    count++;
  }
  int countSE = count;
  while (count > 0) {
    weights.push_back(count);
    count--;
  }
  int totalCount = countW + countE + countS + countN + countSW + countNE +
    countNW + countSE;
  int possibleSize = possible.size();
  int arrayPos = 0;
  for (int i = 0; i < possible.size(); i++) {
    bool questionInBad = false;
    for (int j = 0; j < bad.size(); j++) {
      if (possible.at(i) == bad.at(j)) {
	questionInBad = true;
	break;
      }
    }
    if (questionInBad) {
      possibleSize -= weights.at(arrayPos);
      int remove = arrayPos;
      while (weights.at(remove) != 1) {
	bool possibleRemoveInBad = false;
	int indexToRemoveInBad;
	for (int k = 0; k < bad.size(); k++) {
	  if (possible.at(remove) == bad.at(k)) {
	    possibleRemoveInBad = true;
	    indexToRemoveInBad = k;
	    break;
	  }
	}
	if (possibleRemoveInBad) {
	  vector< vector<int> > newBad;
	  vector< vector<int> > newPossible;
	  vector<int> newWeights;
	  for (int l = 0; l < bad.size(); l++) {
	    if (l != indexToRemoveInBad) {
	      newBad.push_back(bad.at(l));
	    }
	  }
	  for (int m = 0; m < possible.size(); m++) {
	    if (m != remove) {
	      newPossible.push_back(possible.at(m));
	      newWeights.push_back(weights.at(m));
	    }
	  }
	  bad = newBad;
	  possible = newPossible;
	  weights = newWeights;
	}
	else {
	  remove++;
	}
      }
    }
    arrayPos++;
  }
  return possibleSize;
}

// numMovesOptimized is a function that takes in an int dimension, a vector<int>
// queenPos that contains two elements for the queen's x- and y-position
// (respectively), and a vector< vector<int> > bad that contains a list of
// (x, y)-pairs that are invalid for the queen to travel to
int numMovesOptimized(int dim, vector<int> queenPos,
		      vector< vector<int> > bad) {
  int num = 0;
  vector< vector<int> > grid;
  grid.resize(dim);
  for (int i = 0; i < dim; i++) {
    grid.at(i).resize(dim);
    for (int j = 0; j < dim; j++) {
      grid.at(i).at(j) = 0;
    }
  }
  for (int i = 0; i < bad.size(); i++) {
    int x = bad.at(i).at(0);
    int y = bad.at(i).at(1);
    grid.at(x - 1).at(y - 1) = 1;
  }
  int xQueen = queenPos.at(0);
  int yQueen = queenPos.at(1);
  int counter = 0;
  int xTemp;
  int yTemp;
  // west
  xTemp = xQueen;
  yTemp = yQueen;
  xTemp--;
  while (xTemp > 0 && grid.at(xTemp - 1).at(yTemp - 1) == 0) {
    counter++;
    xTemp--;
  }
  // east
  xTemp = xQueen;
  yTemp = yQueen;
  xTemp++;
  while (xTemp <= dim && grid.at(xTemp - 1).at(yTemp - 1) == 0) {
    counter++;
    xTemp++;
  }
  // south
  xTemp = xQueen;
  yTemp = yQueen;
  yTemp--;
  while (yTemp > 0 && grid.at(xTemp - 1).at(yTemp - 1) == 0) {
    counter++;
    yTemp--;
  }
  // north
  xTemp = xQueen;
  yTemp = yQueen;
  yTemp++;
  while (yTemp <= dim && grid.at(xTemp - 1).at(yTemp - 1) == 0) {
    counter++;
    yTemp++;
  }
  // southwest
  xTemp = xQueen;
  yTemp = yQueen;
  xTemp--;
  yTemp--;
  while (xTemp > 0 && yTemp > 0 && grid.at(xTemp - 1).at(yTemp - 1) == 0) {
    counter++;
    xTemp--;
    yTemp--;
  }
  // northeast
  xTemp = xQueen;
  yTemp = yQueen;
  xTemp++;
  yTemp++;
  while (xTemp <= dim && yTemp <= dim &&
	 grid.at(xTemp - 1).at(yTemp - 1) == 0) {
    counter++;
    xTemp++;
    yTemp++;
  }
  // northwest
  xTemp = xQueen;
  yTemp = yQueen;
  xTemp--;
  yTemp++;
  while (xTemp > 0 && yTemp <= dim && grid.at(xTemp - 1).at(yTemp - 1) == 0) {
    counter++;
    xTemp--;
    yTemp++;
  }
  // southeast
  xTemp = xQueen;
  yTemp = yQueen;
  xTemp++;
  yTemp--;
  while (xTemp <= dim && yTemp > 0 && grid.at(xTemp - 1).at(yTemp - 1) == 0) {
    counter++;
    xTemp++;
    yTemp--;
  }
  return counter;
}

// rand5 is a function that generates a random number from 1 to 5
int rand5() {
  return (rand() % 5) + 1;
}

// rand7 is a funcion that generates a random number from 1 to 7 using the rand5
// function
int rand7() {
  int sum = rand5() + rand5() + rand5() + rand5() + rand5() + rand5() + rand5();
  return (sum % 7) + 1;
}

// randProb is a function that shows that rand5 and rand7 are truly random
void randProb() {
  int r5count1 = 0;
  int r5count2 = 0;
  int r5count3 = 0;
  int r5count4 = 0;
  int r5count5 = 0;
  int r7count1 = 0;
  int r7count2 = 0;
  int r7count3 = 0;
  int r7count4 = 0;
  int r7count5 = 0;
  int r7count6 = 0;
  int r7count7 = 0;
  int count = 0;
  while (count < 1000000) {
    int num5 = rand5();
    int num7 = rand7();
    if (num5 == 1) {
      r5count1++;
    }
    else if (num5 == 2) {
      r5count2++;
    }
    else if (num5 == 3) {
      r5count3++;
    }
    else if (num5 == 4) {
      r5count4++;
    }
    else if (num5 == 5) {
      r5count5++;
    }
    if (num7 == 1) {
      r7count1++;
    }
    else if (num7 == 2) {
      r7count2++;
    }
    else if (num7 == 3) {
      r7count3++;
    }
    else if (num7 == 4) {
      r7count4++;
    }
    else if (num7 == 5) {
      r7count5++;
    }
    else if (num7 == 6) {
      r7count6++;
    }
    else if (num7 == 7) {
      r7count7++;
    }
    count++;
  }
  cout << (r5count1*100/200000) << endl;
  cout << (r5count2*100/200000) << endl;
  cout << (r5count3*100/200000) << endl;
  cout << (r5count4*100/200000) << endl;
  cout << (r5count5*100/200000) << endl;
  cout << (r7count1*100/142857) << endl;
  cout << (r7count2*100/142857) << endl;
  cout << (r7count3*100/142857) << endl;
  cout << (r7count4*100/142857) << endl;
  cout << (r7count5*100/142857) << endl;
  cout << (r7count6*100/142857) << endl;
  cout << (r7count7*100/142857) << endl;
}

int main() {
  return 0;
}
