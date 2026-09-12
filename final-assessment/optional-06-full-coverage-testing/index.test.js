import { test } from 'node:test';
import assert from 'node:assert';
import { sum } from './index.js';

test('should return the sum of two positive numbers', () => {
  const result = sum(2, 3);
  assert.strictEqual(result, 5);
});

test('should return the sum of two negative numbers', () => {
  const result = sum(-2, -3);
  assert.strictEqual(result, -5);
});

test('should return the same number when adding zero', () => {
  const result = sum(10, 0);
  assert.strictEqual(result, 10);
});

test('should throw an error when the first argument is not a number', () => {
  assert.throws(() => sum('a', 3), Error);
});

test('should throw an error when the second argument is not a number', () => {
  assert.throws(() => sum(3, 'b'), Error);
});