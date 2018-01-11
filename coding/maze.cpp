#include <iostream>
#include <vector>
#include <string>
using namespace std;

vector<string> directions(vector< vector<int> > maze, vector<int> position);
vector< vector<int> > start(vector< vector<int> > maze);
vector< vector<int> > findPath(vector< vector<int> > maze, vector<int> start,
			       vector<int> end);

vector<string> directions(vector< vector<int> > maze, vector<int> position) {
  vector<string> d;
  bool north = true, northeast = true, east = true, southeast = true,
    south = true, southwest = true, west = true, northwest = true;
  int x = position[0], y = position[1];
  if (y-1 < 0 || maze[x][y - 1] == 1) { north = false; }
  if (y-1 < 0 || x+1 >= maze[0].size() || maze[x+1][y-1] == 1) {
    northeast = false; }
  if (x+1 >= maze[0].size() || maze[x+1][y] == 1) { east = false; }
  if (y+1 >= maze.size() || x+1 >= maze[0].size() || maze[x+1][y+1] == 1) {
    southeast = false; }
  if (y+1 >= maze.size() || maze[x][y+1] == 1) { south = false; }
  if (y+1 >= maze.size() || x-1 < 0 || maze[x-1][y+1] == 1) {
    southwest = false; }
  if (x-1 < 0 || maze[x-1][y] == 1) { west = false; }
  if (y-1 < 0 || x-1 < 0 || maze[x-1][y-1] == 1) { northwest = false; }
  if (north) { d.push_back("north"); }
  if (northeast) { d.push_back("northeast"); }
  if (east) { d.push_back("east"); }
  if (southeast) { d.push_back("southeast"); }
  if (south) { d.push_back("south"); }
  if (southwest) { d.push_back("southwest"); }
  if (west) { d.push_back("west"); }
  if (northwest) { d.push_back("northwest"); }
  return d;
}

vector< vector<int> > start(vector< vector<int> > maze) {
  vector<int> start, end;
  for (int i = 0; i < maze.size(); i++) {
    if (maze[i][0] == 0) {
      if (start.size() == 0) { start = {i, 0}; }
      else if (end.size() == 0) { end = {i, 0}; }
    }
  }
  for (int j = 0; j < maze[0].size(); j++) {
    if (maze[0][j] == 0) {
      if (start.size() == 0) { start = {0, j}; }
      else if (end.size() == 0) { end = {0, j}; }
    }
  }
  for (int j = 0; j < maze[0].size(); j++) {
    if (maze[maze.size()-1][j] == 0) {
      if (start.size() == 0) { start = {(int) maze.size()-1, j}; }
      else if (end.size() == 0) { end = {(int) maze.size()-1, j}; }
    }
  }
  for (int i = 0; i < maze.size(); i++) {
    if (maze[i][maze[0].size()-1] == 0) {
      if (start.size() == 0) { start = {i, (int) maze[0].size()-1}; }
      else if (end.size() == 0) { end = {i, (int) maze[0].size()-1}; }
    }
  }
  return findPath(maze, start, end);
}
  

vector< vector<int> > findPath(vector< vector<int> > maze, vector<int> start,
			       vector<int> end) {
  if (start[0] == end[0] && start[1] == end[1]) { return maze; }
  vector<string> d = directions(maze, start);
  int n = d.size();
  if (n == 0) { return maze; }
  maze[start[0]][start[1]] = 1;
  for (int i = 0; i < n; i++) {
    if (d[i] == "north") { findPath(maze, {start[0], start[1]-1}, end); }
    if (d[i] == "northeast") { findPath(maze, {start[0]+1, start[1]-1}, end); }
    if (d[i] == "east") { findPath(maze, {start[0]+1, start[1]}, end); }
    if (d[i] == "southeast") { findPath(maze, {start[0]+1, start[1]+1}, end); }
    if (d[i] == "south") { findPath(maze, {start[0], start[1]+1}, end); }
    if (d[i] == "southwest") { findPath(maze, {start[0]-1, start[1]+1}, end); }
    if (d[i] == "west") { findPath(maze, {start[0]-1, start[1]}, end); }
    if (d[i] == "northwest") { findPath(maze, {start[0]-1, start[1]-1}, end); }
  }
}

int main() {
  vector< vector<int> > maze;
  return 0;
}
